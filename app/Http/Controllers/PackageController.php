<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PackagePurchaseConfirmation;

class PackageController extends Controller
{
    public function purchase(Request $request, $id)
    {
        if (Auth::user()->role === 'instructor' || Auth::user()->role === 'eigenaar') {
            abort(403, 'Instructeurs en eigenaren kunnen geen pakketten kopen');
        }

        try {
            DB::beginTransaction();

            $userPackage = DB::table('user_packages')->insertGetId([
                'user_id' => Auth::id(),
                'package_id' => $id,
                'location_id' => $request->location_id,
                'timeslot_id' => $request->timeslot_id,
                'start_date' => $request->start_date,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            $package = DB::table('packages')->where('id', $id)->first();
            $location = DB::table('locations')->where('id', $request->location_id)->first();
            $timeslot = DB::table('timeslots')->where('id', $request->timeslot_id)->first();

            $emailData = [
                'userName' => Auth::user()->name,
                'packageName' => $package->name,
                'price' => $package->price,
                'locationName' => $location->name,
                'date' => date('d-m-Y', strtotime($request->start_date)),
                'timeslot' => $timeslot->display_name,
                'orderId' => $userPackage
            ];

            Mail::to(Auth::user()->email)->send(new PackagePurchaseConfirmation($emailData));

            DB::commit();
            return redirect()->route('dashboard')
                ->with('success', 'We hebben de rekening gestuurd naar ' . Auth::user()->email);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Er is iets misgegaan bij het verwerken van je aankoop.');
        }
    }

    public function cancel($id)
    {
        // Verify the instructor is authorized to cancel this package
        $instructor = DB::table('instructors')
            ->where('person_id', Auth::user()->person_id)
            ->first();

        if (!$instructor) {
            abort(403, 'Alleen instructeurs kunnen pakketten annuleren');
        }

        // Check if package belongs to this instructor
        $packageBelongsToInstructor = DB::table('user_packages as up')
            ->join('package_instructors as pi', 'up.package_id', '=', 'pi.package_id')
            ->where('up.id', $id)
            ->where('pi.instructor_id', $instructor->id)
            ->exists();

        if (!$packageBelongsToInstructor) {
            abort(403, 'Je bent niet bevoegd om dit pakket te annuleren');
        }

        // Delete the user_package
        DB::table('user_packages')->where('id', $id)->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Pakket succesvol geannuleerd');
    }
}

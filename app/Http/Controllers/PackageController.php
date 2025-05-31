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
        // Check for existing booking
        $existingBooking = DB::table('user_packages')
            ->where('user_id', Auth::id())
            ->where('start_date', $request->start_date)
            ->where('timeslot_id', $request->timeslot_id)
            ->first();

        if ($existingBooking) {
            return back()->with('error', 'Je hebt al een pakket geboekt op deze datum en tijdstip!');
        }

        // Get instructors for THIS package only
        $packageInstructors = DB::table('package_instructors')
            ->where('package_id', $id)
            ->pluck('instructor_id');

        // Check if any of THIS package's instructors are already booked
        $busyInstructor = DB::table('user_packages as up')
            ->join('package_instructors as pi', 'up.package_id', '=', 'pi.package_id')
            ->whereIn('pi.instructor_id', $packageInstructors)
            ->where('up.start_date', $request->start_date)
            ->where('up.timeslot_id', $request->timeslot_id)
            ->exists();

        if ($busyInstructor) {
            return back()->with('error', 'De instructeur voor dit pakket is niet beschikbaar op dit tijdstip!');
        }

        try {
            $request->validate([
                'location_id' => 'required|exists:locations,id',
                'timeslot_id' => 'required|exists:timeslots,id',
                'start_date' => 'required|date|after:yesterday',
            ]);

            // If all checks pass, proceed with the purchase
            DB::beginTransaction();

            // Insert purchase record
            $userPackageId = DB::table('user_packages')->insertGetId([
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
                'orderId' => $userPackageId
            ];

            Mail::to(Auth::user()->email)->send(new PackagePurchaseConfirmation($emailData));

            DB::commit();
            return redirect()->route('dashboard')
                ->with('success', 'Je pakket is succesvol gekocht! Check je email voor de betalingsgegevens.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return back()
                ->with('error', 'Er is iets misgegaan bij het verwerken van je aankoop: ' . $e->getMessage())
                ->withInput();
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

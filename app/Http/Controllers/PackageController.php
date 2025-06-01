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
        // Remove the existing booking check
        // Check only for time slot conflict
        $busyTimeSlot = DB::table('user_packages')
            ->where('start_date', $request->start_date)
            ->where('timeslot_id', $request->timeslot_id)
            ->whereIn('user_id', [Auth::id()])
            ->exists();

        if ($busyTimeSlot) {
            return back()->with('error', 'Je hebt al een pakket op dit tijdstip!');
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
                'duo_participant_name' => 'required_if:package_id,2,3,4',
                'duo_participant_email' => 'nullable|email',
                'duo_participant_phone' => 'nullable',
            ]);

            DB::beginTransaction();

            // Insert user_package record
            $userPackageId = DB::table('user_packages')->insertGetId([
                'user_id' => Auth::id(),
                'package_id' => $id,
                'location_id' => $request->location_id,
                'timeslot_id' => $request->timeslot_id,
                'start_date' => $request->start_date,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // For duo packages, save participant info
            if (in_array($id, [2, 3, 4]) && $request->duo_participant_name) {
                DB::table('duo_participants')->insert([
                    'user_package_id' => $userPackageId,
                    'name' => $request->duo_participant_name,
                    'email' => $request->duo_participant_email,
                    'phone' => $request->duo_participant_phone,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            // Get all data for email
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
                'orderId' => $userPackageId,
                'duoParticipant' => $request->duo_participant_name ?? null
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

    public function reject(Request $request, $id)
    {
        try {
            $request->validate([
                'reason' => 'required|string|min:10',
            ]);

            DB::beginTransaction();

            // Check if package exists and belongs to user
            $package = DB::table('user_packages')
                ->where('id', $id)
                ->where('user_id', Auth::id())
                ->first();

            if (!$package) {
                return back()->with('error', 'Pakket niet gevonden.');
            }

            // Create rejection record
            DB::table('package_rejections')->insert([
                'user_package_id' => $id,
                'reason' => $request->reason,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now()
            ]);

            DB::commit();

            return redirect()->route('dashboard')
                ->with('success', 'Absentie melding is succesvol ingediend.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->with('error', 'Er is iets misgegaan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function handleRejection(Request $request, $rejectionId)
    {
        $request->validate([
            'status' => 'required|in:approved,denied',
            'response' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            // Get the specific rejection
            $rejection = DB::table('package_rejections')
                ->where('id', $rejectionId)
                ->first();

            if (!$rejection) {
                return back()->with('error', 'Afwijzing niet gevonden.');
            }

            // Update rejection status
            DB::table('package_rejections')
                ->where('id', $rejectionId)
                ->update([
                    'status' => $request->status,
                    'instructor_response' => $request->response,
                    'updated_at' => now(),
                ]);

            // Only delete the specific package if approved
            if ($request->status === 'approved') {
                DB::table('user_packages')
                    ->where('id', $rejection->user_package_id)
                    ->delete();
            }

            DB::commit();
            return redirect()->route('dashboard')
                ->with('success', 'Afwijzing ' . ($request->status === 'approved' ? 'goedgekeurd' : 'afgewezen'));

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Er is iets misgegaan bij het verwerken van de afwijzing.');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Mail\LessonCancellation;

class LessonController extends Controller
{
    public function sendCancellationEmail(Request $request, $packageId)
    {
        if (Auth::user()->role !== 'instructor') {
            abort(403, 'Alleen instructeurs kunnen annuleringsmails versturen');
        }

        DB::beginTransaction();
        try {
            $package = DB::table('user_packages as up')
                ->join('users as u', 'up.user_id', '=', 'u.id')
                ->join('persons as p', 'u.person_id', '=', 'p.id')
                ->join('timeslots as t', 'up.timeslot_id', '=', 't.id')
                ->where('up.id', $packageId)
                ->select('p.full_name as student_name', 'u.email', 'up.start_date', 't.display_name as time_slot')
                ->first();

            if (!$package) {
                return back()->with('error', 'Pakket niet gevonden');
            }

            $emailData = [
                'type' => $request->type,
                'student_name' => $package->student_name,
                'lesson_date' => date('d-m-Y', strtotime($package->start_date)),
                'lesson_time' => $package->time_slot,
                'instructor_name' => Auth::user()->name
            ];

            // Send cancellation email
            Mail::to($package->email)->send(new LessonCancellation($emailData));

            // Delete the package after sending email
            DB::table('user_packages')->where('id', $packageId)->delete();

            DB::commit();
            return back()->with('success', 'Les is geannuleerd en mail is verzonden naar de cursist.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Er is iets misgegaan: ' . $e->getMessage());
        }
    }
}

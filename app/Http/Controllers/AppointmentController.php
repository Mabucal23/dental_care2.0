<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\DoneAppointment;
use App\Mail\AppointmentApproved;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::all();
        return view('admin.patient', ['appointments' => $appointments]);
    }
    public function userIndex()
{
    $appointments = Appointment::where('user_id', Auth::id())->get();
    return view('schedule', ['appointments' => $appointments]);
}
public function userHistory()
{
    $appointments = DoneAppointment::where('user_id', Auth::id())->get();
    return view('patienthistory', ['appointments' => $appointments]);
}
public function adminHistory()
{
    $appointments = DoneAppointment::all();
    return view('admin.patienthistory', ['appointments' => $appointments]);
}
    // Store the appointment data in the database
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'contact_number' => 'required|numeric',
            'email' => 'required|email|max:255',
            'appointment_date' => 'required|date',
            'address' => 'required|string|max:500',
            'status' => 'required|string|max:255',

        ]);

        // Save the appointment to the database
        Appointment::create([
            'user_id' => Auth::id(),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'contact_number' => $request->contact_number,
            'email' => $request->email,
            'appointment_date' => $request->appointment_date,
            'address' => $request->address,
            'status' => $request->status,
        ]);



        // Redirect to the form with a success message
        return redirect()->route('appointment')->with('success', 'Appointment created successfully!');
    }
    public function destroy($id)
    {
        // Find the patient by ID and delete
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        // Redirect back with a success message
        return redirect()->route('admin.patient')->with('success', 'Patient deleted successfully');
    }
    public function approve($id)
    {
        // Find the patient by ID
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'Approved';
        $appointment->save();

        Mail::to($appointment->email)->send(new AppointmentApproved($appointment));

        // Return the updated data or a response
        return redirect()->back()->with('success', 'Appointment approved and email sent successfully!');
    }

    public function markAsDone($id)
    {
        // Find the appointment by ID
        $appointment = Appointment::findOrFail($id);

        // Transfer the appointment data to the done_appointments table
        DoneAppointment::create([
            'user_id' => Auth::id(),
            'first_name' => $appointment->first_name,
            'last_name' => $appointment->last_name,
            'contact_number' => $appointment->contact_number,
            'email' => $appointment->email,
            'appointment_date' => $appointment->appointment_date,
            'address' => $appointment->address,
            'status' => 'Done', // Set the status to 'Done'
        ]);

        // Delete the appointment from the original table
        $appointment->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Appointment marked as done and moved to completed table.');
    }
    public function cancelAppointment($id)
    {
        // Find the appointment by ID
        $appointment = Appointment::findOrFail($id);

        // Transfer the appointment data to the done_appointments table with "Cancelled" status
        DoneAppointment::create([
            'user_id' => Auth::id(),
            'first_name' => $appointment->first_name,
            'last_name' => $appointment->last_name,
            'contact_number' => $appointment->contact_number,
            'email' => $appointment->email,
            'appointment_date' => $appointment->appointment_date,
            'address' => $appointment->address,
            'status' => 'Cancelled', // Set the status as "Cancelled"
        ]);

        // Delete the appointment from the original table
        $appointment->delete();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Appointment has been cancelled and moved to the completed table.');
    }
}

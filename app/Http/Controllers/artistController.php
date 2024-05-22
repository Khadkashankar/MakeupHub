<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Rating;
use App\Appointment;
use App\Artist;

class artistController extends Controller
{


    public function artist_details($id){


        $data['details'] = Artist::find($id);
        return view('artist-details',['data'=>$data]);
    }

    public function appointment($id){
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please log in to book an appointment.');
        }

        $artist = Artist::findOrFail($id);
        return view('appointment', compact('artist'));

    }

    public function storeAppointment(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'artist_id' => 'required|exists:artists,id',
            'appointment_date' => 'required|date',
            'description' => 'required|string',
        ]);
        $validatedData['status'] = 'pending';

        Appointment::create($validatedData);

        return redirect()->route('appointment', ['id' => $validatedData['artist_id']])
            ->with('success', 'Appointment booked successfully.');
    }

    public function myappointments(){
        $userId = Auth::id();

        $appointments = Appointment::with('artist.user')
            ->where('user_id', $userId)
            ->get();

        return view('myappointments', compact('appointments'));
    }

    public function cancelAppointment($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return redirect()->route('myappointments')->with('success', 'Appointment canceled successfully.');
    }

    public function artistDashboard(){
                    $user_id = Auth::id();
                $artist_id = Artist::where('u_id', $user_id)->value('id');

                $total_users = Appointment::where('artist_id', $artist_id)
                                    ->distinct('user_id')
                                    ->count('user_id');

                $total_appointments = Appointment::where('artist_id', $artist_id)
                                        ->count();

                $data = [
                    'total_users' => $total_users,
                    'total_appointments' => $total_appointments,
                ];

                return view('artist.dashboard', ['data' => $data]);
    }

    public function registered(){
        $user_id = Auth::id();

        $artist_id = Artist::where('u_id', $user_id)->value('id');

        $data = Appointment::select('users.*')
                ->join('users', 'users.id', '=', 'appointments.user_id')
                ->where('appointments.artist_id', $artist_id)
                ->distinct('appointments.user_id')
                ->get();

            return view('artist.registered', ['data' => $data]);
    }

    public function deleteuser(Request $req){
    	$user = User::find($req->id);

    	$user->delete();
    	return redirect('registered-user')->with('success', 'Deleted successfully !!');
    }

    public function useredit($id){
    	$user = User::find($id);
    	return view('artist.useredit',['user'=>$user]);
    }

    function updateuser(Request $req){
        $data = User::find($req->id);

        $data->name = $req->name;
        $data->email = $req->email;
        $data->phone = $req->phone;

        $data->save();

        return redirect('registered-user')->with('success','Updated Successfully !! ');
    }

    public function appointments(){
        $user_id = Auth::id();
        $artist_id = Artist::where('u_id', $user_id)->value('id');

        $data = Appointment::select('appointments.*', 'users.name as user_name', 'users.phone as user_phone', 'users.email as user_email')
            ->join('users', 'users.id', '=', 'appointments.user_id')
            ->where('appointments.artist_id', $artist_id)
            ->get();

            return view('artist.appointment', ['data' => $data]);
    }

    public function confirmAppointment($id) {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'confirmed';
        $appointment->save();

        return redirect()->route('appointments')->with('success', 'Appointment confirmed successfully.');
    }

    public function appointsdelete(Request $req){
    	$appoints = Appointment::find($req->id);

    	$appoints->delete();
    	return redirect('appointments')->with('success', 'Deleted successfully !!');
    }

    public function show(){
        $user = Auth::user();

        $artist = Artist::where('u_id', $user->id)->first();
        return view('artist.profile', compact('user', 'artist'));

    }

    public function editprofile()
    {
        $user = Auth::user();
        $artist = Artist::where('u_id', $user->id)->first();

        return view('artist.editProfile', compact('user', 'artist'));
    }

    public function updateprofile(Request $request)
    {
        $user = Auth::user();
        $artist = Artist::where('u_id', $user->id)->first();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:10',
            'speciality' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->save();

        $artist->speciality = $request->input('speciality');
        $artist->description = $request->input('description');
        $artist->location = $request->input('location');
        $artist->price = $request->input('price');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('artistimages'), $imageName);
            $artist->image = $imageName;
        }

        $artist->save();

        return redirect()->route('myProfile')->with('success', 'Profile updated successfully.');
    }

}

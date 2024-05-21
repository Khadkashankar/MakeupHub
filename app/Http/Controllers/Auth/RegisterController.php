<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Artist;
use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
      protected function redirectTo(){
        if (Auth::User()->usertype ==='admin') {
            return 'dashboard';
        } elseif (Auth::User()->usertype ==='artist') {
            return 'artist-dashboard';
        } else {
            return '/';
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'numeric', 'min:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
            'usertype' => ['required', 'string', 'in:user,artist'],
        ];

        if ($data['usertype'] === 'artist') {
            $rules['description'] = ['required', 'string', 'max:1000'];
            $rules['speciality'] = ['required', 'string', 'max:255'];
            $rules['image'] = ['required', 'image', 'mimes:jpeg,png,jpg,avif'];
            $rules['price'] = ['required', 'numeric'];
        }

        return Validator::make($data, $rules);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'usertype' => $data['usertype'],
            'password' => Hash::make($data['password']),
        ]);

        if ($data['usertype'] === 'artist') {
            $filename = null;
            if (isset($data['image'])) {
                $file = $data['image'];
                $originalName = $file->getClientOriginalName();
                $filename = time() . '.' . $originalName;
                $file->move(public_path('artistimages/'), $filename);
            }

            Artist::create([
                'u_id' => $user->id,
                'image' => $filename,
                'description' => $data['description'],
                'location' => $data['location'],
                'speciality' => $data['speciality'],
                'price' => $data['price'],
            ]);
        }
        return $user;
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
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
    protected $redirectTo = RouteServiceProvider::HOME;

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
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'refrence_id' => ['required', 'string', 'exists_in_siswa_or_guru'], // Custom rule
        ]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        $refrenceId = $data['refrence_id'];

        // Check if refrence_id exists in the 'siswa' table
        $siswa = \App\Models\Siswa::where('nisn', $refrenceId)->first();

        // Check if refrence_id exists in the 'guru' table
        $guru = \App\Models\Guru::where('nip', $refrenceId)->first();

        if ($siswa) {
            // If refrence_id exists in 'siswa' table, create a user with role 'siswa'
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'is_admin' => "siswa", // Set 'is_admin' to false for non-admin users
                'reference_id' => $refrenceId, // Set the reference_id
            ]);
        } elseif ($guru) {
            // If refrence_id exists in 'guru' table, create a user with role 'guru'
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'is_admin' => "guru", // Set 'is_admin' to true for admin users
                'reference_id' => $refrenceId, // Set the reference_id
            ]);
        }
    }
}

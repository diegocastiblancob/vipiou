<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

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
            'name' => ['required', 'regex:/^[\pL\s\-]+$/u', 'max:255'],
            'lastname' => ['required', 'regex:/^[\pL\s\-]+$/u', 'max:255'],
            'identification' => ['required', 'numeric'],
            'city' => ['required', 'regex:/^[\pL\s\-]+$/u', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'numeric', 'max:10'],
            'name_company' => ['required', 'regex:/^[\pL\s\-]+$/u', 'max:255'],
            'nit_company' => ['required', 'numeric'],
            'owner_company' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $date = Carbon::now();
        $endDate = $date->addDays(15); 
        return User::create([
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'identification' => $data['identification'],
            'city' => $data['city'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'name_company' => $data['name_company'],
            'nit_company' => $data['nit_company'],
            'logo_company' => 'default-logo.png',
            'owner_company' => $data['owner_company'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'status' => 1,
            'expiration_date' => $endDate
        ]);
    }
}

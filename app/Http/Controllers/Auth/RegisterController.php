<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Http\Request;

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
    protected $redirectTo = '/';

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
            'name' => 'required|string|max:255',
            'fist_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function register(Request $request)
    {
        User::create([
            'name' => $request->input('name'),
            'fist_name' => $request->input('fist_name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'account_type' => $request->input('account_type'),
            'org_id' => $request->input('org_id'),
            'is_admin' => 'N',
            'id_number' => $request->input('id_number'),
        ]);

        $redirectTo = '/home';
    }
    /* protected function register(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'fist_name' => $data['fist_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'account_type' => $data['account_type'],
            'org_id' => $data['org_id'],
            'is_admin' => 'N',
            'id_number' => $data['id_number'],
        ]);
    } */
}

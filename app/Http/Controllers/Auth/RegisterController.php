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
            'account_type' => 'string|max:2',
            'org_id' => 'string|max:2',
            'is_admin' => 'string|max:1',
            'id_number' => 'string|max:10',
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
        if($request->input('account_type') == 'CL'){
            $request->validate([
                'name' => 'required|string|regex:/^[A-Za-z\s-_]+$/|max:255',
                'first_name' => 'required|string|regex:/^[A-Za-z\s-_]+$/|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'terms_of_service' => 'required',
                'org_id' => 'string|max:2',
            ]);
        }else{
            $request->validate([
                'name' => 'required|string|regex:/^[A-Za-z\s-_]+$/|max:255',
                'first_name' => 'required|string|regex:/^[A-Za-z\s-_]+$/|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'terms_of_service' => 'required',
                'id_number' => 'required|string|max:10'
            ]);
        }
        
        User::create([
            'name' => $request->input('name'),
            'first_name' => $request->input('first_name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'account_type' => $request->input('account_type'),
            // 'org_id' => $request->input('org_id'),
            'is_admin' => 'N',
            'id_number' => $request->input('id_number'),
        ]);

        return view('layouts.registered');
    }
    /* protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'first_name' => $data['first_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'account_type' => $data['account_type'],
            'org_id' => '',
            'is_admin' => 'N',
            'id_number' => $data['id_number'],
        ]); 
    }*/
}

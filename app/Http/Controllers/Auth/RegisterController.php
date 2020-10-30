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
            'phone_number' => ['required', 'numeric'],
            'gender' => ['required', 'integer', 'digits:1'],
            'birth_date' => ['required','date'],
            'province' => ['required','string'],
            'city' => ['required','string'],
            'sub_district' => ['required','string'],
            'postal_code' => ['required','numeric'],
            'detail' => ['required','string']
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
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone_number' => $data['phone_number'],
            'gender' => $data['gender'],
            'birth_date' => $data['birth_date'],
            'province' => $data['province'],
            'city' => $data['city'],
            'sub_district' => $data['sub_district'],
            'postal_code' => $data['postal_code'],
            'detail' => $data['detail']
        ]);
        $user->assign('user');
        return $user;
    }

    public function showRegistrationForm()
    {
        $indonesia = file_get_contents(base_path('resources/js/indonesia.json'));
        $indonesia = \GuzzleHttp\json_decode($indonesia);
        return view('auth.register', compact('indonesia'));
    }
}

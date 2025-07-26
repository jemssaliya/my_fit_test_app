<?php

namespace App\Http\Controllers\Auth;

use App\Notifications\WelcomeMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use EMedia\Oxygen\Http\Controllers\Auth\RegisterController as OxygenRegisterController;

class RegisterController extends OxygenRegisterController
{
    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // protected function validator(array $data)
    // {
    // 	return Validator::make($data, [
    // 		'first_name' => 'required|max:255',
    // 		'last_name' => 'required|max:255',
    // 		'phone' => 'required|max:20',
    // 		'email' => 'required|email|max:255|unique:users',
    // 		'password' => 'required|min:6|confirmed',
    // 	]);
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return User
     */
    // public function register(array $data)
    // {
    //     dd('duck');
    // 	return User::create([
    // 		'name' => $data['fname'],
    // 		'last_name' => $data['lname'],
    // 		'contact_no' => $data['phone'],
    // 		'title' => $data['title'],
    // 		'email' => $data['email'],
    // 		'password' => bcrypt($data['password']),
    // 	]);
    // }
    // protected function registered(Request $request, $user)
    // {
    //     $user->country_code = $request->country_code;
    //     $user->phone = $request->phone;
    //     $user->save();
    // }

    /**
     * @param array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'timezone' => $data['timezone'],
        ]);
    }

    /**
     * The user has been registered.
     *
     * @param \Illuminate\Http\Request $request
     * @param mixed $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        try {
            /** @var User $user */
            $user->notify(new WelcomeMail());

        } catch (\Exception $exception) {
            Log::error('Welcome mail could not send - ' . $exception->getMessage());
        }
    }
}

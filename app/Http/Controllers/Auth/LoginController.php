<?php


namespace App\Http\Controllers\Auth;

use EMedia\Oxygen\Http\Controllers\Auth\LoginController as OxygenLoginController;

class LoginController extends OxygenLoginController
{

    // 2 factor auth
    public function show2FA()
	{
		if (view()->exists('auth.code')) {
			return view('auth.code');
		}

		return view('oxygen::auth.code');
	}

}
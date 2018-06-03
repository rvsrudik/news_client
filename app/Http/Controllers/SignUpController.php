<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SignUpController extends Controller
{
    public function redirectUser() {
		$user = Auth::user();

		print_r($user);
	}
}

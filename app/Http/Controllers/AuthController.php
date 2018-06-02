<?php

namespace App\Http\Controllers;

use App\Users;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


use Illuminate\Http\Request;


class AuthController extends Controller
{



	private function new_user($email, $pass)
	{
		$user = new  Users;

		$user->email = $email;
		$user->password = Hash::make($pass);

		$user->save();
		return 1;
	}


	private function is_user_exist($email)
	{
		$user = new  Users;

		$exist = $user::where('email', $email)->count();

		if ($exist) {
			return 1;
		}

		return 0;
	}



	public function registration( Request $request )
	{
		$answer = array("status" => "fail", "description" => "Unexpected error. Please, try later.");

		if ($request->post('email') === "" || $request->post('password') === "") {
			$answer['description'] = "Fill all fields.";

			return (json_encode($answer));
		}

		if ($this->is_user_exist($request->post('email'))) {
			$answer['description'] = "This user alreay exist.";

			return (json_encode($answer));
		}

		if ($this->new_user($request->post('email'), $request->post('password'))) {
			$answer['status'] = "success";
			$answer['description'] = "User was successfully created. Please activate your account.";

			return (json_encode($answer));
		}

		return (json_encode($answer));
	}



}

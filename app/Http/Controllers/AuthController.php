<?php

namespace App\Http\Controllers;

use App\Mail\RegistrationConfirm;
use App\Users;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


use Illuminate\Support\Facades\Mail;



use Illuminate\Http\Request;


class AuthController extends Controller
{



	private function new_user($email, $pass, $key)
	{
		$user = new  Users;

		$user->email = $email;
		$user->password = Hash::make($pass);
		$user->key = $key;

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

		$email = $request->post('email');
		$pass = $request->post('password');
		$key =  time();
		$answer = array("status" => "fail", "description" => "Unexpected error. Please, try later.");

		if ($email === "" || $pass === "") {
			$answer['description'] = "Fill all fields.";

			return (json_encode($answer));
		}

		if ($this->is_user_exist($email)) {
			$answer['description'] = "This user alreay exist.";

			return (json_encode($answer));
		}

		if ($this->new_user($email, $pass, $key)) {
			$answer['status'] = "success";
			$answer['description'] = "User was successfully created. Please activate your account.";


			Mail::to($email)->send(new RegistrationConfirm($email, $key));
			return (json_encode($answer));
		}

		return (json_encode($answer));
	}


	public function activation( Request $request ) {
		$user = new  Users;

//		print_r($request->email());

//		$user = $user::update(['confirmed' => 1]);

		$user->update(['confirmed' => 1, 'key = ""']);

		return "your account activated";
	}



}

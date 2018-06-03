<?php

namespace App\Http\Controllers;

use App\Mail\RegistrationConfirm;
use App\Users;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


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

	public function login( Request $request )
	{
		$answer = array("status" => "fail", "description" => "Unexpected error. Please, try later.");
		$email = $request->post('email');
		$pass = $request->post('password');



		if (Auth::attempt(['email' => $email, 'password' => $pass, 'confirmed' => 1])) {
			$answer['status'] = "settings";
			$answer['description'] = "redirect to settings";
			return json_encode($answer);
		} else if (Auth::attempt(['email' => $email, 'password' => $pass, 'confirmed' => 2])) {
			$answer['status'] = "login";
			return json_encode($answer);
		} else if (Auth::attempt(['email' => $email, 'password' => $pass, 'confirmed' => 0])) {
			$answer['description'] = "Please, activate account first";
			return json_encode($answer);
		} else {
			$answer['description'] = "Wrong email or password";
			return json_encode($answer);
		}
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



	protected function activate_user($id) {
		User::where('id', $id)->update(['confirmed' => 1, 'key' => ""]);
	}



	public function activation( $email, $key ) {

		$user_id = Users::where(['email' => $email, 'key' => $key])->value('id');

		if ($user_id) {
			$this->activate_user($user_id);
		} else {
			return abort(404);
		}

		return redirect()->route('auth', ['msg' => "activated"]);

	}



}

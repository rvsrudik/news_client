<?php

namespace App\Http\Controllers;
use App\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


use Illuminate\Http\Request;

class ProfileController extends Controller
{

	private function validEmail($email) {
		$id = Auth::id();

		$user_email = Users::where('id', $id)->value('email');

//		$exist = $user::where('email', $email)->count();


//		print_r( $user_email);

//		echo $email;
		if ($email === $user_email) {
			return (0);
		}


		$same_email =  Users::where('email', $email)->value('id');

		if ($same_email) { return "This email already exist"; }

		return 0;
	}

	private function validPassword($pass1, $pass2) {
		if ($pass1 !== $pass2) {
			return "Passwords are different";
		}


		return 0;
	}

	public function show() {
		$id = Auth::id();

		$user = Users::where('id', $id)->select('name', 'email', 'lastname', 'country', 'city', 'phone', 'birthday', 'pic')->get()->toArray()[0];


		return view( 'profile', [ 'name' =>  $user['name'], 'email' => $user['email'], 'city' => $user['city'],
								  		'lastname' => $user['lastname'],'country' => $user['country'],
								  		'phone' => $user['phone'],'birthday' => $user['birthday'],
								  		'pic' => $user['pic'],] );

	}

	public function updateProfile(Request $request) {
		$answer = array("status" => "succes", "description" => "Your info was updated.");
		$errors = [];
		$id = Auth::id();


		$email = $request->input('email');
		$password1 = $request->input('password1');
		$password2 = $request->input('password2');
		$name = $request->input('name');
		$lastname = $request->input('lastname');
		$country = $request->input('country');
		$city = $request->input('city');
		$phone = $request->input('phone');
		$birth = $request->input('birth');
		$pic = $request->input('pic');
		$password = Users::where('id', $id)->value('password');

		if ( $res = $this->validEmail($email) ) {
			$answer['status'] = 'fail';
			$errors[] = $res;
		}

		if ( $res = $this->validPassword($password1, $password2) ) {
			$answer['status'] = 'fail';
			$errors[] = $res;
		} else {
			$password =  Hash::make($password1);
		};

		if (count($errors)) {
			$answer['description'] = $errors;
		}




		Users::where('id', $id)->update(['name' => $name, 'password' => $password , 'email' => $email, 'pic'=> $pic ,'lastname' => $lastname, 'country' => $country, 'city' => $city, 'phone' => $phone, 'birthday' => $birth, 'confirmed' => 2, 'news_sources' => '["google-news-uk", "cnn", "espn", "daily-mail", "mtv-news"]']);

		print_r(json_encode($answer));
	}
}

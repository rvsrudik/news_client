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

		if ($email == NULL) {
			return ( "Email can't be empty. <br>" );
		}
		$user_email = Users::where('id', $id)->value('email');

		if ($email === $user_email) {
			return (0);
		}

		$same_email =  Users::where('email', $email)->value('id');

		if ($same_email) {
			return "This email already exist. <br>";
		}

		$pattern = '/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/';

		preg_match($pattern, $email, $matches);

		 if (!$matches) {
			return("Wrong email format. <br>");
		}

		return 0;
	}

	private function validPassword($pass1, $pass2) {
		if ($pass1 !== $pass2) {
			return "Passwords are different. <br>";
		}

		return 0;
	}


	private function validName($name) {
		if ($name == NULL) {
			return ( "Name can't be empty. <br>" );
		}

		$pattern = '/[a-zA-Z]{3,10}/';

		preg_match($pattern, $name, $matches);

		if (!$matches) {
			return("Wrong name format. Use only letters. 3-10 symbols. <br>");
		}

		return 0;
	}

	private function validLastName($lastname) {

		if ($lastname == NULL) {
			return ( "Last name can't be empty. <br>" );
		}

		$pattern = '/[a-zA-Z]{3,10}/';

		preg_match($pattern, $lastname, $matches);

		if (!$matches) {
			return("Wrong last name format. Use only letters. 3-10 symbols. <br>");
		}

		return 0;
	}

	private function validPhone($phone) {

		if ($phone == NULL) {
			return ( "Phone can't be empty. <br>" );
		}

		$pattern = '/^[0-9\-\(\)\/\+\s]*$/';



		preg_match($pattern, $phone, $matches);

		if (!$matches) {
			return("Wrong phone number. <br>");
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

		if ( $res = $this->validName($name) ) {
			$answer['status'] = 'fail';
			$errors[] = $res;
		}

		if ( $res = $this->validLastName($lastname) ) {
			$answer['status'] = 'fail';
			$errors[] = $res;
		}

		if ( $res = $this->validPhone($phone) ) {
			$answer['status'] = 'fail';
			$errors[] = $res;
		}


		if ( $res = $this->validPassword($password1, $password2) ) {
			$answer['status'] = 'fail';
			$errors[] = $res;
		} else {
			if ($password1 !== NULL) {
				$password =  Hash::make($password1);
			}
		};


		if (count($errors)) {
			$answer['description'] = $errors;
		} else {
			Users::where('id', $id)->update(['name' => $name, 'password' => $password , 'email' => $email, 'pic'=> $pic ,'lastname' => $lastname, 'country' => $country, 'city' => $city, 'phone' => $phone, 'birthday' => $birth, 'confirmed' => 2, 'news_sources' => '["google-news-uk", "cnn", "espn", "daily-mail", "mtv-news"]']);
		}

		print_r(json_encode($answer));
	}
}

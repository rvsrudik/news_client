<?php

namespace App\Http\Controllers;
use App\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserInfoController extends Controller
{

	public function finishregistration(Request $request) {

		$id = Auth::id();

		$name = $request->input('user_name');
		$lastname = $request->input('user_lastname');
		$country = $request->input('user_country');
		$city = $request->input('user_city');
		$phone = $request->input('user_phone');
		$birth = $request->input('user_bith');

		Users::where('id', $id)->update(['name' => $name, 'lastname' => $lastname, 'country' => $country, 'city' => $city, 'phone' => $phone, 'birthday' => $birth, 'confirmed' => 2, 'news_sources' => '["google-news-uk", "cnn", "espn", "daily-mail", "mtv-news"]']);


		return redirect('/');
	}

	public function updateSources(Request $request) {
		$id = Auth::id();

		$json_sources = json_encode($request->post('sources'));

		Users::where('id', $id)->update(['news_sources' => $json_sources]);

		return "succes";
	}

	public function getSources() {
		$id = Auth::id();

		$json_sources = Users::where('id', $id)->value('news_sources');

		return $json_sources;
	}
}

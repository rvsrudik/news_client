<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Users;

use Illuminate\Http\Request;

class PeopleController extends Controller
{
    public function getUsers() {

		$users = Users::paginate(20);


		return view('people', ['users' => $users]);

//		return 'People page';
	}
}

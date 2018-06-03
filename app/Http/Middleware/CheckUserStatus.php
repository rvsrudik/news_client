<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use App\Users;



use Closure;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		$id = Auth::id();


		if (!$id) {
			return redirect('/auth');
		} else {
			$status = Users::where(['id' => $id])->value('confirmed');

			if ($status === 1) {
				return redirect('/set_account');
			}
		}

		return $next($request);
    }
}

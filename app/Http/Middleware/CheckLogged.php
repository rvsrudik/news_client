<?php

namespace App\Http\Middleware;
use App\Users;
use Illuminate\Support\Facades\Auth;

use Closure;

class CheckLogged {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Closure $next
	 *
	 * @return mixed
	 */
	public function handle( $request, Closure $next ) {
		$id = Auth::id();

		if ( $id ) {
			$status = Users::where( [ 'id' => $id ] )->value( 'confirmed' );

			if ( $status === 1 ) {
				return redirect( '/set_account' );
			}
			else if ($status === 2) {
				return redirect( '/' );
			}
		}
		return $next( $request );
	}
}

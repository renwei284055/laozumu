<?php 

namespace App\Http\Services\User;
use App\Models\User;
use Predis;
use Crypt;

class AuthUserToken{

	static public function index($csrf)
	{

		try{

			$csrf = explode('|', Crypt::decrypt( $csrf ) ) ;

			return  isset( $csrf[1] ) && $csrf[1] > time() ? $csrf[0] : false ;

		}catch(\Exception $e)
		{
			return false;
		}
	}


}
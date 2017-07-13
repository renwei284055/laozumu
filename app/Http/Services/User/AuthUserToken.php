<?php 

namespace App\Http\Services\User;
use App\Models\User;
use Predis;

class AuthUserToken{

	static public function index($csrf)
	{

		try{

			


		}catch(\Exception $e)
		{
			return false;
		}
		return $csrf;
	}

}
<?php

namespace App\Http\Services\User;

use Crypt;

class GenToken{

	private $day=7*24*3600;

	public function index($token)
	{

		return Crypt::encrypt( $token.'|'.(time()+$this->day) ) ;


	}
}

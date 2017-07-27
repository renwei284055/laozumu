<?php

namespace App\Http\Services\User;

use App\Http\Models\User;
use Predis;

class GetMessage{

	public function index($phone)
	{
		$result=user::where('mobile',$phone)->select('mobile')->first();
		return $result;
	}
}

<?php

namespace App\Http\Services\User;

use App\Http\Models\User;
use Predis;
class ServiceTest{


	public function index()
	{
		//$user = Redis::set('a',345454);
		return [
		'redis'=>Predis::get('a'),
		'db'=>User::get()

			];


	}
}

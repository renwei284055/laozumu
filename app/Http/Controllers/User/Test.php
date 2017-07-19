<?php 

namespace App\Http\Controllers\User;
use App\Http\Base;
use Illuminate\Http\Request;
use App\Http\Library\InputClean;
use Validator;
use App\Http\ResponseBack;

use App\Http\Services\User\ServiceTest;
use App\Http\Services\User\GenToken;

class Test extends Base
{

	public function index(Request $request)
	{


        if (Validator::make($request->all(), [
	            'title' => 'required',
	            'body' => 'required',
	        ])->fails()) {

        	return ResponseBack::resultParam();
        }
        return ResponseBack::resultResponse( 

        		['token'=>$request->get('token')]
         );

	}
	public function index1(Request $request)
	{

        $token=new GenToken();
        return ResponseBack::resultResponse( 

        		['token1'=>$token->index($request->route('token'))]
         );

	}
}
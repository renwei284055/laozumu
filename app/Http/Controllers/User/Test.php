<?php 

namespace App\Http\Controllers\User;
use App\Http\Base;
use Illuminate\Http\Request;
use App\Http\Library\InputClean;
use Validator;
use App\Http\ResponseBack;

use App\Http\Services\User\ServiceTest;

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


        if (Validator::make($request->all(), [
	            'a' => 'required',
	            'b' => 'required',
	        ])->fails()) {

        	return ResponseBack::resultParam();
        }

        $data=InputClean::index($request->all());


        $user=new ServiceTest();

        return ResponseBack::resultResponse( 

        		['token1'=>$request->get('token'),'id'=>$request->route('id'),'list'=>$user->index()]
         );

	}
}
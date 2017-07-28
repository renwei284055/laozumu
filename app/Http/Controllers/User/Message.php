<?php 

namespace App\Http\Controllers\User;
use App\Http\Base;
use Illuminate\Http\Request;
use Validator;
use App\Http\ResponseBack;
use App\Http\Library\OauthSign;

use App\Http\Services\User\GetMessage;

class Message extends Base
{

	public function send(Request $request)
	{
		// $input = $request->only(['uid','phone']);
		// var_dump($input);exit;
        //检查手机号是否被注册过
        $phonemodel = new GetMessage();
        $get['uid'] = $request->route('uid');
        $get['phone'] = $request->route('phone');
        if (Validator::make($get, [
	            'uid' => 'required',
	            'phone' => 'required',
	        ])->fails()) {

        	return ResponseBack::resultParam();
        }

        $usephone = $phonemodel->index($request->route('phone'));
        //为null时说明手机号没有注册过
        if($usephone != null){
        	return ResponseBack::resultResponse( 
                        2
                 );
        }
        
        //发送短信
        $rand = rand(1000,9999);
 		$senddata = array(

        			'phone' => $request->route('phone'), 
        			'rand' => $rand
        	);
        
        $receivedata=OauthSign::sendMessage($senddata);
        if($receivedata->success != true){
        	return ResponseBack::resultResponse( 
                        1
                 );
        }

        $returndata = array(

        			'phone' => $request->route('phone'), 
        			'rand' => $rand
        	);
        return ResponseBack::resultResponse( 

        		['data'=>$returndata]
         );			

	}
	
}
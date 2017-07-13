<?php 

namespace App\Http;
use Illuminate\Http\Response;

class ResponseBack
{

	static public function resultResponse($r=null,$version=null)
    {

      $code=config('code');
     

      $data=[
          'code'    => 1000,
          'version' => $version?$version:'1.0',
          'status'  => 'SUCCESS',
          'error'  => '',
          'content' => '',
        ];

        switch (true) 
        {
            case empty($r):
              break;
            case is_numeric($r)&&$r!=1000:
                $data['code']   = (int)   $r;
                $data['status'] =         'FAIL';
                $data['error']  =         isset( $code[$r] )? $code[$r]:'';
                break;
            case !is_array($r): 	
            case !isset($r['code']):
            	$data['content']=$r;
                break;
            case $r['code']!=1000:
                
            	$data['code']   = (int)   $r['code'];
                $data['status'] =         'FAIL';
                $data['error']  =    	  isset( $code[$r] )? $code[$r]:'';
                break;
            default:
                $data['content']=$r;
                break;
        }

        return response()->json($data);
    }
    static public function resultToken()
    {
        return   self::resultResponse(3001);
    }
    static public function resultParam()
    {
        return  self::resultResponse(2001);
	}
}
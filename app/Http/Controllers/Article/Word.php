<?php 
/**
*@author 任伟 2017-7-17
*@ 汉字查询接口
**/
namespace App\Http\Controllers\Article;
use App\Http\Base;
use Illuminate\Http\Request;
use App\Http\Library\InputClean;
use App\Http\Library\WordTranslate;
use Validator;
use App\Http\ResponseBack;

class Word extends Base
{

	public function translate(Request $request)
	{
		

        //传入key和word
        $data = array(

        			'word' => $request->route('word'), 
        			'key' => "033d03f4e88889856e29a877013e44b0"
        	);
        $data=WordTranslate::translate($data);

        //翻译失败
        if($data['error_code'] != 0){
                return ResponseBack::resultResponse( 
                        1
                 );
        }

        return ResponseBack::resultResponse( 

        		['translate'=>$data]
         );
	}
}
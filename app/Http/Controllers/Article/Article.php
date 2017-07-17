<?php 
/**
    *@author leishangjie 2017-7-17
    *@brief 文章相关
**/
namespace App\Http\Controllers\Article;
use App\Http\Base;
use Illuminate\Http\Request;
use App\Http\Library\InputClean;
use Validator;
use App\Http\ResponseBack;

use App\Http\Services\Article\GetParagraphTranslate;

class Article extends Base
{

	public function paragraph(Request $request)
	{

        $translate=new GetParagraphTranslate();
        return ResponseBack::resultResponse( 

        		['translate'=>$translate->index($request->route('id'))]
         );

	}
}
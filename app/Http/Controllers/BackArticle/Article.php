<?php 
/**
    *@author leishangjie 2017-7-18
    *@brief 文章相关
**/
namespace App\Http\Controllers\BackArticle;
use App\Http\Base;
use Illuminate\Http\Request;
use App\Http\Library\InputClean;
use Validator;
use App\Http\ResponseBack;

use App\Http\Services\BackArticle\ImportArticle;

class Article extends Base
{

	public function import(Request $request)
	{

        $ImportArticle=new ImportArticle();

        $path=base_path('public/11.xlsx');

        return ResponseBack::resultResponse( 

        		$ImportArticle->index( $path  )
         );

	}
}
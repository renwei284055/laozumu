<?php
/**
    *@author leishangjie 2017-7-17
    *@brief 获取段落翻译
    *@param id 段落编号
    *@return 段落翻译
**/
namespace App\Http\Services\Article;

use App\Http\Models\BookParagraph;


class GetParagraphTranslate{


	public function index($id)
	{
		return BookParagraph::where('id',$id)->select('translation')->first();
	}
}

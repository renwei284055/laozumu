<?php
/**
    *@author leishangjie 2017-7-19
    *@brief 获取图书内容
    *@param aid 图书编号 cid 章节编号

**/
namespace App\Http\Services\Article;

use App\Http\Models\BookParagraph;


class GetArticle{


	public function index($aid,$cid)
	{

		$articles=BookParagraph::where('bid',$aid)->where('cpid',$cid)->select('id','cpsid','content')->get();

		$result=[];

		foreach ($articles as $article) 
		{
			
			$result[$article->cpsid]['paragraph'][$article->id]=$article->content;
		}

		return $result;

	}
}

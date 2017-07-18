<?php
/**
    *@author leishangjie 2017-7-18
    *@brief 获取图书目录
    *@param id 图书编号
    *@return 目录
**/
namespace App\Http\Services\Article;

use App\Http\Models\BookChapter;


class GetCatalog{


	public function index($id)
	{
		
		$logs=BookChapter::where('bid',$id)->select('chapter','chapter_id','small_chapter_name','small_chapter_id')->get();	
		
		$result=[];

		foreach ($logs as $log) 
		{
			empty($log->chapter)?null:$result[$log->chapter_id]['chapter_name']=$log->chapter;

			isset($result[$log->chapter_id]['list'])?null:$result[$log->chapter_id]['list']=array();

			empty($log->small_chapter_id)?null:$result[$log->chapter_id]['list'][]=[

				'small_chapter_id'=>$log->small_chapter_id,
				'small_chapter_name'=>$log->small_chapter_name
			];


		}
		return $result;

	}
}

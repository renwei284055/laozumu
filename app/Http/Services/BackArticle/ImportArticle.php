<?php 

namespace App\Http\Services\BackArticle;

use Maatwebsite\Excel\Facades\Excel;
use DB;
use App\Http\Models\Book;
use App\Http\Models\BookChapter;
use App\Http\Models\BookParagraph;

class ImportArticle{

	public function index($file)
	{
		$result=[];

		Excel::load($file, function($reader)use(&$result){

		    $reader 	= $reader->getSheet(0);
		    $results 	= $reader->toArray();

		    unset($results[0]);

		    if(empty($results))
		    {
		    	$result = 4001;
		    	return false;
		    }


	    	DB::beginTransaction();
	        try{ 
		            DB::transaction(function()use($results)
		            {
		            	$bid=0;
		            	$bcid=0;
		            	$bsid=0;

				        foreach ($results as $key => $value)
				        {

				        	if(!empty($value[0]))
				        	{
				        		$book=new Book();
				        		$book->name=$value[0];
				        		$book->author=$value[1];
				        		$book->desc=$value[2];
				        		$book->save();
				        		$bid=$book->id;

				        		$book=null;
				        		$bsid=0;
				        		$bcid=0;
				        	}

				        	if(!empty($value[3]))
				        	{
				        		$bsid=0;
				        		$bcid++;

				        		$chapter=new BookChapter();
					        	$chapter->bid=$bid;
					        	$chapter->chapter=$value[4];
					        	$chapter->chapter_id=$bcid;
					        	$chapter->author=$value[5];
					        	$chapter->type=$value[6];

					        	$chapter->save();
					        	$chapter=null;

				        	}

				        	if(!empty($value[7]))
				        	{
				        		$bsid++;

				        		$chapter=new BookChapter();

					        	$chapter->bid=$bid;
					        	$chapter->chapter_id=$bcid;
					        	$chapter->small_chapter_id=$bsid;
					        	$chapter->small_chapter_name=$value[8];

					        	$chapter->save();
					        	$chapter=null;
				        	}


				        	if(!empty($value[9]))
				        	{

				        		$paragraph=new BookParagraph();
				        		$paragraph->bid=$bid;
				        		$paragraph->cpid=$bcid;
				        		$paragraph->cpsid=$bsid;
				        		$paragraph->content=$value[9];
				        		$paragraph->translation=$value[10];

				        		$paragraph->save();

				        	}
				        }
				        
			    	});
			    	 DB::commit();
		       	}catch(\Exception $e) 
		    	{ 
		            DB::rollback();
		            $result =  ['code'=>4002,'error'=>$e->getMessage()];

	        	}
		});
		return $result;
	}
}


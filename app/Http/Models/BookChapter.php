<?php

namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;

class BookChapter extends Model
{
    protected $table = 'book_chapter';
    protected $primaryKey='id';
    public $timestamps = false;
}

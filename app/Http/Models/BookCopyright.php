<?php

namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;

class BookCopyright extends Model
{
    protected $table = 'book_copyright';
    protected $primaryKey='id';
    public $timestamps = false;
}

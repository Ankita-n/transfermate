<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';

    protected $fillable = [
       'author_id','book_id','title','genre','price','publish_date','description'
    ];

}

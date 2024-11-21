<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryNew extends Model
{
    use HasFactory;
    const ACTIVE = 1;
    const UNACTIVE = 2;
    const UNDELETE = 1;
    const DELETE = 2;

    protected $table = 'category_news';
    protected $fillable = [
        'id', 'name','description',
        'status','deleted_at','created_at','updated_at'
   
    ];
}

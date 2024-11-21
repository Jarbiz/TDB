<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    
    use HasFactory;
    const ACTIVE = 1;
    const UNACTIVE = 2;
    const UNDELETE = 1;
    const DELETE = 2;

    protected $table = 'news';
    protected $fillable = [
        'id', 'status','created_at','updated_at','title',
        'cate_new_id','user_id','short_desc','images','description','deleted_at'
     
   
    ];
    public function CategoryNew()
    {
        return $this->hasOne(CategoryNew::class, 'id', 'cate_new_id');

    }
}

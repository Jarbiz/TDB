<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTamp extends Model
{
    use HasFactory;


    protected $table = 'order_tamp';
    protected $fillable = [
        'id', 'course_id','created_at','updated_at','price','user_id'
     
   
    ];
}

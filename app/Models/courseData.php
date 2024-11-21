<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class courseData extends Model
{
    use HasFactory;
    protected $table = 'course_data';
    protected $fillable = [
        'id', 'course_id','created_at','updated_at','video','description'
     
   
    ];

}

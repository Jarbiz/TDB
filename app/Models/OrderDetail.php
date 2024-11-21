<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'orders_detail';
    protected $fillable = [
        'id','created_at','updated_at','orders_id','user_id','course_id','price'
    ];

    public function Course()
    {
            return $this->hasOne(Course::class, 'id', 'course_id');
    }

    public function Order()
    {
            return $this->hasOne(Order::class, 'id', 'orders_id');
    }
}

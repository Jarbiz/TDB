<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RateYo extends Model
{
    use HasFactory;
    const notApprovedYet = 1;
    const Approved = 2;
    const Refuse = 3;

    protected $table = 'rate_yo';

    protected $fillable = [
        'id', 'course_id',
        'status','comment', 
        'created_at','updated_at',
        'rate','user_id'
    ];

    public function Course(){
        return $this->hasOne(Course::class, 'id', 'course_id');
    }
    public function User()
    {
            return $this->hasOne(User::class, 'id', 'user_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestUser extends Model
{
    use HasFactory;
    protected $table = 'test_user';

    protected $fillable = [
        'id', 'test_id','question_id','answer_user_id','created_at','updated_at','answer'
    ];

    public function Question(){
        return $this->hasOne(Question::class, 'id', 'question_id');
    }
}

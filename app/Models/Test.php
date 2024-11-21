<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;
    const UNFINISHED = 1;
    const COMPLETE = 2;
    protected $table = 'test';
 

    protected $fillable = [
        'id', 'status','course_data_id',
        'user_id','score','created_at','updated_at'
    ];
    protected $appends = [
        'status_name',
    ];

    public function getStatusNameAttribute() {
        if($this->status == 1){
            return "Chưa chấm điểm";
        }else{
            return "Đã chấm điểm";
        }
        
    }

    public function TestUser()
    {
        return $this->hasMany(TestUser::class, 'test_id');

    }

    
}

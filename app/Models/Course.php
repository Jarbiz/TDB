<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    
    use HasFactory;
    const ACTIVE = 1;
    const UNACTIVE = 2;
    const UNDELETE = 1;
    const DELETE = 2;

    const BASIC =1;
    const ADVANCED = 2;
    protected $table = 'course';
    protected $fillable = [
        'id', 'name','description','price','user_id','number_of_lessons','course_type','status','deleted_at','created_at','updated_at'
     
   
    ];
    protected $appends = [
        'course_type_name',
        'sum_rate_yo'
    ];

    public function getSumRateYoAttribute(){
        $sum = 0;
        $number = 0;
       
            if(count($this->RateYo) > 0 ){
                foreach($this->RateYo as $rate){
              
                    $number ++;
                    $sum += $rate->rate;
                }
            }
        
  
        return $sum/$number;
    }
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');

    }

    public function CourseData()
    {
        return $this->hasMany(courseData::class, 'course_id');

    }
    public function RateYo()
    {
        return $this->hasMany(RateYo::class, 'course_id')->where('status', 2);
    }

    public function getCourseTypeNameAttribute(){
        if($this->course_type == 1){
            return "Khóa học cơ bản";

        }else{
            return "Khóa học nâng cao";
        }
    }
}

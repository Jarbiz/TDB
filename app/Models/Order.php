<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    const NOT_YET_PAIN = 1;
    const PAIN = 2;
    const CANCELED = 3;
    protected $table = 'orders';
    protected $fillable = [
        'id', 'status','created_at','updated_at','total','user_id','deleted_at',
     
    ]; 
    protected $appends = [
        'status_name',
    ];

    public function getStatusNameAttribute() {
        if($this->status == 1){
            return "Chưa thanh toán";
        }else if($this->status == 2){
            return "Đã thanh toán";
        }else{
            return "Đã hủy";

        }
        
    }
    public function OrderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'orders_id');

    }
    public function User()
    {
            return $this->hasOne(User::class, 'id', 'user_id');
    }

   
}

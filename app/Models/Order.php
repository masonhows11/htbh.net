<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $table= 'orders';
    use HasFactory;

    protected $fillable = ['user_id','total_price','is_paid'];


    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

}

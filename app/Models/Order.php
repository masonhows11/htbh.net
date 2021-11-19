<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $table= 'orders';
    use HasFactory;

    protected $fillable = [

    ];


    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

}

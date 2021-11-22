<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $fillable = ['user_id','amount','hash_id','hash_pay','order_id','is_paid'];

    public function order()
    {
        return $this->hasOne(Order::class);
    }
}

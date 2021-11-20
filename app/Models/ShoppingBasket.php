<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingBasket extends Model
{
    use HasFactory;

    protected $table = 'shopping_baskets';

    protected $fillable = ['course_id','user_id','qty','price'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = ['title','name','parent_id'];


    public function child()
    {
        return $this->HasMany(Category::class,'parent_id');
    }
}

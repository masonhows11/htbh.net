<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use HasFactory,Sluggable;


    protected $table = 'categories';

    protected $fillable = ['title','name','slug','parent_id'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function child()
    {
        return $this->HasMany(Category::class,'parent_id');
    }
    public static function getParent($parent_id)
    {
      return  self::where('id',$parent_id)->first();
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\Lesson;

class Course extends Model
{
    use HasFactory,Sluggable;

    protected $table = "courses";

    protected $fillable =
        ['title',
        'name',
        'user_id',
        'description',
        'image',
        'price',
        'level_course',
        'status_course',
        'status_paid',];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function seasons()
    {
        return $this->hasMany(Season::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }



    public function lessons()
    {
        return $this->hasMany(\App\Models\Lesson::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function basket()
    {
        return $this->belongsTo(Basket::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Season extends Model
{
    protected $table = "seasons";

    use HasFactory,Sluggable;

    protected $fillable = [ 'title','name','slug','course_id','lesson_id'];


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }



}



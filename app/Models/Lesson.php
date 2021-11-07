<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class Lesson extends Model
{
    use HasFactory,Sluggable;

    protected $fillable =
        ['course_id',
         'season_id',
        'title',
        'name',
        'video_path',
        'lesson_duration',
        'buy_able'];

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

    public function season()
    {
        return $this->belongsTo(Season::class);
    }
}

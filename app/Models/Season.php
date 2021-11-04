<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    protected $table = "seasons";
    use HasFactory;
    protected $fillable = [ 'title','name','course_id','lesson_Id'];
}
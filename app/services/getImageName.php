<?php


namespace App\services;


class getImageName
{

    public static function articleImage($imagePath)
    {
      return  $image = str_ireplace('http://htbh.edu/storage/article/','',$imagePath);
    }

    public  static function courseImage($imagePath)
    {
        return  $image = str_ireplace('http://htbh.edu/storage/course/','',$imagePath);
    }

}

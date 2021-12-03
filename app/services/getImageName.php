<?php


namespace App\services;


class getImageName
{

    public static function articleName($imagePath)
    {
      return  $image = str_ireplace('http://htbh.edu/storage/article/','',$imagePath);
    }

    public  static function courseName($imagePath)
    {
        return  $image = str_ireplace('http://htbh.edu/storage/course/','',$imagePath);
    }

}

<?php


namespace App\services;


class postImageName
{

    public static function getName($imagePath)
    {
      return  $image = str_ireplace('http://htbh.edu/storage/article/','',$imagePath);
    }

}

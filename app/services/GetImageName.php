<?php


namespace App\services;


class GetImageName
{

    public static function getName($imagePath)
    {
      return  $image = str_ireplace('http://localhost/storage/article/','',$imagePath);
    }

}

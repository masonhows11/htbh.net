<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $category = Category::create([
           'title'=>'کامپیوتر',
            'name'=>'computer',
        ]);

        $category->child()->saveMany([
           new Category([
               'title'=>'برنامه نویسی وب',
               'name'=>'back-end programming',
           ]) ,
            new Category([
                'title'=>'طراحی سایت',
                'name'=>'front-end programming',
            ])
        ]);

    }
}

<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
class ArticleController extends Controller
{
    //
    public function article($article)
    {
        try {
            $article = Post::with(['likes','user','comments'=> function ($query) {
                $query->where('approved', 1);
            }])->where('slug', '=', $article)->first();
            return view('front.article_page.article')->with('article',$article);
        }catch (\Exception $ex)
        {
            return view('errors.error_not_found_model');
        }
    }
}

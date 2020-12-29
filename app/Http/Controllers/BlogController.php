<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $Article = Article::paginate(10);

        return view('welcome', [
            'Article' => $Article
        ]);
    }

    public function StoreArticle(Request $request)
    {
        $Article = new Article;
        $Article->title = $request['title'];
        $Article->slug = Str::slug($request['title'],'-');
        $Article->content = $request['content'];
        $Article->save();

        return redirect ('/');
    }

    public function show($slug)
    {
        $Article = Article::where('slug', $slug)->firstOrFail();

        return view('welcome', [
            'Article' => $Article
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\article;
use Illuminate\Http\Request;

class home extends Controller
{
    public function index()
    {
        return view('welcome', [
            'article' => article::all()
        ]);
    }
    public function show($id)
{
    $article = Article::find($id);
    return view('article.show', ['article' => $article]);
}
}

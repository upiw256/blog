<?php

namespace App\Http\Controllers;

use App\Models\article;
use App\Models\Teacher;
use Illuminate\Http\Request;

class home extends Controller
{
    public function index()
    {
        return view('layout.content.home', [
            'article' => article::all()
        ]);
    }
    public function show($id)
    {
        $article = Article::find($id);
        return view('layout.content.article', ['article' => $article]);
    }
    public function search(Request $request)
    {
        $query = $request->input('query');

        $articles = Article::where('title', 'like', '%' . $query . '%')
            ->orWhere('content', 'like', '%' . $query . '%')
            ->get();

        return view('layout.content.search_results', compact('articles', 'query'));
    }
    public function teachers() {
        Teacher::all();
        return view('layout.content.teachers', [
            'teachers' => Teacher::all()
        ]);
    }
}

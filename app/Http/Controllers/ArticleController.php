<?php

namespace App\Http\Controllers;

use App\Models\article;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $isPublished = $request->has('is_published') ? $request->boolean('is_published') : true; // Default to published

        $articles = Article::with('user')->where('is_published', $isPublished)->get();
        return Response::json($articles);
    }
}

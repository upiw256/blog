<?php

namespace App\Http\Controllers;

use App\Models\article;
use App\Models\contact;
use App\Models\ExtracurricularActivity;
use App\Models\achievement_img;
use App\Models\Teacher;
use Illuminate\Http\Request;

class home extends Controller
{
    public function index()
    {
        $articles = Article::where('is_published', true)->get();
        $extras = ExtracurricularActivity::all();
        $achievenent = achievement_img::all();
        return view('layout.content.home', [
            'article' => $articles,
            'extras' => $extras,
            'achievenent' => $achievenent
        ]);
    }
    public function show($slug)
    {
        $article = Article::where('slug',$slug)->firstOrFail();
        if ($article->is_published == 0) {
            return redirect('/');
        }
        return view('layout.content.article', ['article' => $article]);
    }


    public function search(Request $request)
    {
        $query = $request->input('query');
        $articles = Article::where(function ($innerQuery) use ($query) {
            $innerQuery->where('title', 'like', "%$query%")
                      ->orWhere('content', 'like', "%$query%");
        })
        ->where('is_published', true)
        ->orderBy('created_at', 'desc') // Optional: Customize sorting if needed
        ->paginate(10); // Optional: Use pagination for efficiency and UX
    
        // Return compact view with relevant data
        return view('layout.content.search_results', compact('articles', 'query'));

    }
    public function teachers()
    {
        Teacher::all();
        return view('layout.content.teachers', [
            'teachers' => Teacher::all()
        ]);
    }
    public function contact(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Buat instance dari model Contact dan simpan data ke dalam database
        $contact = new contact();
        $contact->name = $validatedData['name'];
        $contact->email = $validatedData['email'];
        $contact->subject = $validatedData['subject'];
        $contact->message = $validatedData['message'];
        $contact->save();
        // dd($contact);

        // Redirect pengguna ke halaman yang sesuai atau kirimkan respon JSON jika Anda menggunakan API
        return redirect()->back()->with('success', 'Pesan berhasil dikirim! Terima kasih.');
    }
}

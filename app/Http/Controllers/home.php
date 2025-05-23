<?php

namespace App\Http\Controllers;

use App\Models\achievement;
use App\Models\article;
use App\Models\contact;
use App\Models\ExtracurricularActivity;
use App\Models\ClassRoom;
use App\Models\headmaster;
use App\Models\Schedule;
use App\Models\staf;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class home extends Controller
{
    public function index()
    {
        $articles = Article::where('is_published', 1)->get();
        $extras = ExtracurricularActivity::all();
        $achievenent = Achievement::latest()->limit(10)->get();
        $schedules = Schedule::with(['teacherSubject.teacher', 'teacherSubject.subject', 'classRoom'])->get();
        $student = Student::count();
        $classRooms = ClassRoom::where('jenis_rombel_str', 'Kelas')->get();
        $teacher = Teacher::where('jenis_ptk_id_str', 'Guru')
            ->orWhere('jenis_ptk_id_str', 'Guru TIK')
            ->orWhere('jenis_ptk_id_str', 'Kepala Sekolah')
            ->count();
        $tu = Teacher::where('jenis_ptk_id_str', 'Tenaga Kependidikan')
            ->count();
        $classRoom = ClassRoom::where('jenis_rombel_str', 'Kelas')->count();
        $staf = staf::all();
        $kepsek = headmaster::with('teacher')->latest()->first();
        // dd($kepsek);
        return view('layout.content.home', [
            'article' => $articles,
            'extras' => $extras,
            'achievenent' => $achievenent,
            'student' => $student,
            'teacher' => $teacher,
            'classRoom' => $classRoom,
            'staf' => $staf,
            'kepsek' => $kepsek,
            'tu' => $tu,
            'schedules' => $schedules,
            'classRooms' => $classRooms
        ]);
    }
    public function show($slug)
    {
        // $user = Auth::user();
        $article = Article::where('slug', $slug)->firstOrFail();
        $suggestedArticles = Article::where('is_published', '=', true)->inRandomOrder()->limit(5)->get();
        // dd($suggestedArticles);
        if ($article->is_published == 0) {
            return redirect('/');
        }
        return view('layout.content.article', ['article' => $article, 'suggestedArticles' => $suggestedArticles]);
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
        $teachers = Teacher::all();
        $tu = Teacher::where('jenis_ptk_id_str', 'Tenaga Administrasi Sekolah')
            ->orWhere('jenis_ptk_id_str', 'Petugas Keamanan')
            ->orWhere('jenis_ptk_id_str', 'Tenaga Perpustakaan')
            ->get();
        return view('layout.content.teachers', [
            'teachers' => $teachers,
            'tu' => $tu
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

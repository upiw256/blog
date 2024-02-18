<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Contact extends Component
{
    public $name;
    public $email;
    public $subject;
    public $message;
    public $successMessage;
    public function store()
    {
        $recaptchaToken = request()->input('recaptchaToken');
        $recaptchaSecret = 'YOUR_RECAPTCHA_SECRET_KEY';
        $recaptchaResponse = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$recaptchaSecret}&response={$recaptchaToken}");
        $recaptchaResult = json_decode($recaptchaResponse);

        if (!$recaptchaResult->success) {
            session()->flash('error', 'reCAPTCHA validation failed.');
            return;
        }

        $validatedData = $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Simpan data ke dalam database menggunakan model Eloquent
        \App\Models\Contact::create($validatedData);

        // Reset nilai properti formulir setelah data disimpan
        Session::flash('success', 'Pesan berhasil dikirim! Terima kasih.');
        $this->reset();
    }
    public function render()
    {
        return view('livewire.contact');
    }
}

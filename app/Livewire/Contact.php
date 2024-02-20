<?php

namespace App\Livewire;

use App\Models\contact as ModelsContact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Mews\Captcha\Facades\Captcha;

class Contact extends Component
{

    public $name;
    public $email;
    public $subject;
    public $message;
    public $captcha;

    public $captchaUrl;
    public function mount()
    {
        $this->refreshCaptcha();
    }
    
    public function refreshCaptcha()
    {
        // Reset nilai captcha untuk memuat ulang CAPTCHA
        $this->captchaUrl = route('captcha') . '?' . time();
    }
    #[Validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
        'captcha' => 'required|captcha',
    ])]
    public function store()
    {

        if ($this->validate()) {
            ModelsContact::create([
                'name' => $this->name,
                'email' => $this->email,
                'subject' => $this->subject,
                'message' => $this->message,
            ]);
        }

        $this->reset();
        $this->refreshCaptcha();
        // return redirect()->to('/');

    }
    public function flat()
    {
        return Captcha::create('flat');
    }

    public function render()
    {
        return view('livewire.contact', [
            'captcha' => captcha_img(),
        ]);
    }
}

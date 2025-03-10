<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Graduation;
use App\Models\Student;

class SearchGraduation extends Component
{
    public $nisn;
    public $results = [];

    public function search()
    {
        $this->results = Graduation::whereHas('student', function ($query) {
            $query->where('nisn', 'like', '%' . $this->nisn . '%');
        })->get();
    }

    public function render()
    {
        return view('livewire.search-graduation', [
            'results' => $this->results,
        ]);
    }
}

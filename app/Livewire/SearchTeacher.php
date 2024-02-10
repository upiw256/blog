<?php

namespace App\Livewire;

use App\Models\Teacher;
use Livewire\Component;

class SearchTeacher extends Component
{
    public $search = '';
    public $perPage = 10;
    public function render()
    {
        $teachers = Teacher::where('nama', 'like', '%' . $this->search . '%')
            // ->first()
            ->paginate($this->perPage);
        // dd($teachers);

        return view('livewire.search-teacher', ['teachers' => $teachers]);

    }
}

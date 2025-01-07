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
            ->where('jenis_ptk_id_str', '!=', 'Tenaga Kependidikan')
            ->where('jenis_ptk_id_str', '!=', 'Petugas Keamanan')
            ->where('jenis_ptk_id_str', '!=', 'Tenaga Perpustakaan')
            ->paginate($this->perPage);
        $tu = Teacher::where('jenis_ptk_id_str', 'Tenaga Kependidikan')
            ->orWhere('jenis_ptk_id_str', 'Petugas Keamanan')
            ->orWhere('jenis_ptk_id_str', 'Tenaga Perpustakaan')
            ->get();
        // dd($teachers);

        return view('livewire.search-teacher', ['teachers' => $teachers, 'tu' => $tu]);

    }
}

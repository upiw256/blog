<?php

namespace App\Livewire;

use App\Models\Teacher;
use Livewire\Component;
use Livewire\WithPagination;

class SearchTeacher extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    protected $queryString = ['search']; // Only keep the 'search' query string

    public function updatingSearch()
    {
        $this->resetPage(); // Reset pagination when the search term changes
    }

    public function render()
    {
        $teachers = Teacher::query()
            ->whereRaw('LOWER(nama) LIKE ?', ['%' . strtolower($this->search) . '%']) // Apply search filter
            ->whereNotIn('jenis_ptk_id_str', ['Tenaga Kependidikan', 'Petugas Keamanan', 'Tenaga Perpustakaan']) // Exclude specific types
            ->paginate($this->perPage)
            ->withQueryString(); // Include only the 'search' query string

        $tu = Teacher::whereIn('jenis_ptk_id_str', ['Tenaga Kependidikan', 'Petugas Keamanan', 'Tenaga Perpustakaan'])->get();

        return view('livewire.search-teacher', [
            'teachers' => $teachers,
            'tu' => $tu,
        ]);
    }
}

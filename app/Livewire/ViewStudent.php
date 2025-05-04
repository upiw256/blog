<?php

namespace App\Livewire;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Livewire\Component;
use Filament\Infolists\Infolist;
class ViewStudent extends Component implements HasForms, HasInfolists
{
    use InteractsWithInfolists;
    use InteractsWithForms;
    public function render()
    {
        return view('livewire.view-student');
    }
}

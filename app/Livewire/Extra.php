<?php

namespace App\Livewire;

use App\Models\ExtracurricularActivity;
use App\Models\member_extra;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\Attributes\Url;

class Extra extends Component
{

    #[Url( as: 'nama')]
    public $search = '';
    public function render($id)
    {
        $extras = ExtracurricularActivity::find($id);
        $memberExtra = new member_extra();
        $member = $memberExtra->count_member($id);
        $this->search = $memberExtra->with('student')->where('extracurricular_activity_id', $id)->paginate(5);
        // dd($student);
        return view('livewire.extra', [
            'id' => $extras,
            'member' => $member,
            'students' => $this->search
        ]);
    }
}

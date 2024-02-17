<?php

namespace App\Livewire;

use App\Models\ExtracurricularActivity;
use App\Models\member_extra;
use Illuminate\Http\Request;
use Livewire\Component;

class Extra extends Component
{

    public function render($id)
    {
        $extras = ExtracurricularActivity::find($id);
        $memberExtra = new member_extra();
        $member = $memberExtra->count_member($id);
        $student = $memberExtra->with('student')->where('extracurricular_activity_id', $id)->get();
        // dd($student);
        return view('livewire.extra', [
            'id' => $extras,
            'member' => $member,
            'students' => $student
        ]);
    }
}

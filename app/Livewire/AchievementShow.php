<?php

namespace App\Livewire;

use App\Models\achievement;
use App\Models\achievement_img;
use App\Models\achievement_member;
use Livewire\Component;

class AchievementShow extends Component
{
    public function render($id)
    {
        $achievement = achievement::find($id);
        $student = achievement_member::with("student")->where("achievement_id", $achievement->id)->paginate(5);
        $img = achievement_img::where("achievement_id", $achievement->id)->get();
        return view('livewire.achievement-show', [
            'achievement' => $achievement,
            'students' => $student,
            'imgs' => $img
        ]);
    }
}

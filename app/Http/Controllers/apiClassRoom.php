<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use Illuminate\Http\Request;

class apiClassRoom extends Controller
{
    public function index()
    {
        return ClassRoom::all();
    }
}

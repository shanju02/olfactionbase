<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OlfactionWheelController extends Controller
{
    public function index()
    {
        return view('olfaction-wheel.index');
    }
}

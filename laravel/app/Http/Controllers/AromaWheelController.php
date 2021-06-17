<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AromaWheelController extends Controller
{
    public function index()
    {
        return view('aroma.index');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EresepController extends Controller
{
    public function index()
    {
        return view('eresep.index');
    }
}

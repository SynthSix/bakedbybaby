<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebLayoutController extends Controller
{
    public function web_layout()
    {
        return view('weblayout');
    }
}

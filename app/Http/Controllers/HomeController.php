<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Home',
        ];
        dd(auth('web')->user());
        return view('pages.home', $data);
    }
}

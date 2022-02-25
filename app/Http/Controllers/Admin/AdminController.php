<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Admins',
            'sidebar_active' => 'admins',
            'breadcrumbs' => [
                ['text' => 'Home', 'status' => null, 'link' => route('admin-dashboard')],
                ['text' => 'Admins', 'status' => 'active', 'link' => '#'],
            ],
        ];
        return view('admin.pages.admins.index', $data);
    }
}

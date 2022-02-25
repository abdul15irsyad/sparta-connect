<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'sidebar_active' => 'dashboard',
            'breadcrumbs' => [
                // ['text' => 'Home', 'status' => 'null', 'link' => route('dashboard')],
                ['text' => 'Home', 'status' => 'active', 'link' => '#'],
            ],
        ];
        return view('admin.pages.dashboard.index', $data);
    }
}

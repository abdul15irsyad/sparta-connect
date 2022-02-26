<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class UserController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Users',
            'sidebar_active' => 'users',
            'breadcrumbs' => [
                ['text' => 'Home', 'status' => null, 'link' => route('admin.dashboard')],
                ['text' => 'Users', 'status' => 'active', 'link' => '#'],
            ],
        ];
        return view('admin.pages.users.index', $data);
    }
}

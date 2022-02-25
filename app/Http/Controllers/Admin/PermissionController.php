<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Http\Request;


class PermissionController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Permissions',
            'sidebar_active' => 'permissions',
            'breadcrumbs' => [
                ['text' => 'Home', 'status' => null, 'link' => route('admin-dashboard')],
                ['text' => 'Permissions', 'status' => 'active', 'link' => '#'],
            ],
        ];
        return view('admin.pages.permissions.index', $data);
    }
}

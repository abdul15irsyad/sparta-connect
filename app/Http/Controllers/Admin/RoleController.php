<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Http\Request;


class RoleController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Roles',
            'sidebar_active' => 'roles',
            'breadcrumbs' => [
                ['text' => 'Home', 'status' => null, 'link' => route('admin-dashboard')],
                ['text' => 'Roles', 'status' => 'active', 'link' => '#'],
            ],
        ];
        return view('admin.pages.roles.index', $data);
    }
}

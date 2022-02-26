<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class UserActivityLogController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'User Activity Log',
            'sidebar_active' => 'user-activity-log',
            'breadcrumbs' => [
                ['text' => 'Home', 'status' => null, 'link' => route('admin.dashboard')],
                ['text' => 'User Activity Log', 'status' => 'active', 'link' => '#'],
            ],
        ];
        return view('admin.pages.user-activity-log.index', $data);
    }
}

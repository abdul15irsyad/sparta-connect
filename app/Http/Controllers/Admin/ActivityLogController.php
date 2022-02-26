<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Http\Request;


class ActivityLogController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Activity Log',
            'sidebar_active' => 'activity-log',
            'breadcrumbs' => [
                ['text' => 'Home', 'status' => null, 'link' => route('admin.dashboard')],
                ['text' => 'Activity Log', 'status' => 'active', 'link' => '#'],
            ],
        ];
        return view('admin.pages.activity-log.index', $data);
    }
}

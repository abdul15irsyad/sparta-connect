<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class ActivityLogController extends Controller
{
    // public function datatable(Request $request)
    // {
    //     $admin = AdminUser::find($request->input('authUserId'));
    //     // if the user is not authorize
    //     if (!$admin || $admin->cannot('read-activity-log')) {
    //         return response()->json([
    //             'status' => false,
    //             'msg' => 'invalid credentials',
    //         ], 400);
    //     }

    //     // if request is not from ajax
    //     if (!$request->ajax()) {
    //         return response()->json([
    //             'status' => false,
    //             'msg' => 'invalid credentials',
    //         ], 400);
    //     }

    //     $data = AdminUser::orderBy('created_at', 'desc')->get();

    //     return DataTables::of($data)
    //         ->addIndexColumn()
    //         ->addColumn('action', function ($row) use ($admin) {
    //             $btn = '<div class="text-center">';
    //             if ($admin->can('read-activity-log'))
    //                 $btn .= '<a href="' . route('admin.activity-log.show', ['id' => $row->id]) . '" class="btn btn-sm btn-transparent" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fas fa-fw fa-info-circle"></i></a>';
    //             $btn .= '</div>';
    //             return $btn;
    //         })
    //         ->rawColumns(['action'])
    //         ->make(true);
    // }

    public function index()
    {
        $this->authorize('read-activity-log');

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

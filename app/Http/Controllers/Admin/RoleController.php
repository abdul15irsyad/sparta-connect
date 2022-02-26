<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminRole;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function datatable(Request $request)
    {
        // if request is not from ajax
        if (!$request->ajax()) {
            return response()->json([
                'status' => false,
                'msg' => 'invalid credentials',
            ], 400);
        }

        $data = AdminRole::orderBy('created_at', 'desc')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<div class="text-center">';
                $btn .= '<a href="' . route('admin.roles.show', ['id' => $row->id]) . '" class="btn btn-sm btn-transparent" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fas fa-fw fa-info-circle"></i></a>';
                $btn .= '<a href="' . route('admin.roles.edit', ['id' => $row->id]) . '" class="btn btn-sm btn-transparent" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-fw fa-pen"></i></a>';
                if (!in_array($row->id, [1, 2])) {
                    $btn .= '<button class="btn btn-sm btn-transparent btn-delete text-danger" data-toggle="tooltip" data-placement="top" title="Delete" data-name="' . $row->name . '" data-model="role" data-link="' . route('admin.roles.destroy', ['id' => $row->id]) . '" data-toggle="modal" data-target=".modal-delete"><i class="fas fa-fw fa-trash-alt"></button>';
                }
                $btn .= '</div>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function index()
    {
        $data = [
            'title' => 'Roles',
            'sidebar_active' => 'roles',
            'breadcrumbs' => [
                ['text' => 'Home', 'status' => null, 'link' => route('admin.dashboard')],
                ['text' => 'Roles', 'status' => 'active', 'link' => '#'],
            ],
        ];
        return view('admin.pages.roles.index', $data);
    }
}

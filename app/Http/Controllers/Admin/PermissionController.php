<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminPermission;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    public function datatable(Request $request)
    {
        $admin = AdminUser::find($request->input('authUserId'));
        // if the user is not authorize
        if (!$admin || $admin->cannot('read-permission')) {
            return response()->json([
                'status' => false,
                'msg' => 'invalid credentials',
            ], 400);
        }

        // if request is not from ajax
        if (!$request->ajax()) {
            return response()->json([
                'status' => false,
                'msg' => 'invalid credentials',
            ], 400);
        }

        $data = AdminPermission::orderBy('created_at', 'desc')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) use ($admin) {
                $btn = '<div class="text-center">';
                // if ($admin->can('read-permission'))
                // $btn .= '<a href="' . route('admin.permissions.show', ['id' => $row->id]) . '" class="btn btn-sm btn-transparent" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fas fa-fw fa-info-circle"></i></a>';
                if ($admin->can('update-permission'))
                    $btn .= '<a href="' . route('admin.permissions.edit', ['id' => $row->id]) . '" class="btn btn-sm btn-transparent" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-fw fa-pen"></i></a>';
                if ($admin->can('delete-permission'))
                    $btn .= '<button class="btn btn-sm btn-transparent btn-delete text-danger" data-toggle="tooltip" data-placement="top" title="Delete" data-name="' . $row->name . '" data-model="permission" data-link="' . route('admin.permissions.destroy', ['id' => $row->id]) . '" data-toggle="modal" data-target=".modal-delete"><i class="fas fa-fw fa-trash-alt"></button>';
                $btn .= '</div>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function index()
    {
        $this->authorize('read-permission');

        $data = [
            'title' => 'Permissions',
            'sidebar_active' => 'permissions',
            'breadcrumbs' => [
                ['text' => 'Home', 'status' => null, 'link' => route('admin.dashboard')],
                ['text' => 'Permissions', 'status' => 'active', 'link' => '#'],
            ],
        ];
        return view('admin.pages.permissions.index', $data);
    }

    public function create()
    {
        $this->authorize('create-permission');

        $data = [
            'title' => 'Create Permission',
            'sidebar_active' => 'permissions',
            'breadcrumbs' => [
                ['text' => 'Home', 'status' => null, 'link' => route('admin.dashboard')],
                ['text' => 'Permissions', 'status' => null, 'link' => route('admin.permissions.index')],
                ['text' => 'Create', 'status' => 'active', 'link' => '#'],
            ],
        ];
        return view('admin.pages.permissions.create', $data);
    }

    public function store(Request $request)
    {
        $this->authorize('create-permission');

        $request->merge([
            'slug' => Str::slug($request->input('name'))
        ]);
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required|unique:admin_permissions,slug',
        ]);

        $permission = new AdminPermission;
        $permission->name = $request->input('name');
        $permission->slug = $request->input('slug');
        $permission->save();

        $permission = AdminPermission::where('slug', $request->input('slug'))->first();

        return redirect()
            ->route('admin.permissions.index')
            ->with('type', 'success')
            ->with('message', 'create permission successfull');
    }

    public function edit($id)
    {
        $this->authorize('update-permission');

        $permission = AdminPermission::findOrFail($id);

        $data = [
            'title' => 'Edit Permission',
            'sidebar_active' => 'permissions',
            'breadcrumbs' => [
                ['text' => 'Home', 'status' => null, 'link' => route('admin.dashboard')],
                ['text' => 'Permissions', 'status' => null, 'link' => route('admin.permissions.index')],
                ['text' => 'Edit', 'status' => 'active', 'link' => '#'],
            ],
            'permission' => $permission,
        ];
        return view('admin.pages.permissions.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('update-permission');

        $permission = AdminPermission::findOrFail($id);

        $request->merge([
            'slug' => Str::slug($request->input('name'))
        ]);
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required|unique:admin_permissions,slug,' . $id . ',id',
        ]);

        $permission->name = $request->input('name');
        $permission->slug = $request->input('slug');
        $permission->save();

        return redirect()
            ->route('admin.permissions.index')
            ->with('type', 'success')
            ->with('message', 'update permission successfull');
    }

    public function destroy($id)
    {
        $this->authorize('delete-permission');

        $permission = AdminPermission::findOrFail($id);

        $permission->delete();

        return redirect()
            ->route('admin.permissions.index')
            ->with('type', 'success')
            ->with('message', 'delete permission successfull');
    }
}

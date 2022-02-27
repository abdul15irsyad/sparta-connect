<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminRole;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    protected $except_roles;

    public function __construct()
    {
        $this->except_roles = ['super-admin', 'admin'];
    }

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
                if (!in_array($row->slug, ['super-admin', 'admin'])) {
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

    public function show($id)
    {
        $role = AdminRole::findOrFail($id);

        $data = [
            'title' => 'Detail Role',
            'sidebar_active' => 'roles',
            'breadcrumbs' => [
                ['text' => 'Home', 'status' => null, 'link' => route('admin.dashboard')],
                ['text' => 'Roles', 'status' => null, 'link' => route('admin.roles.index')],
                ['text' => 'Detail', 'status' => 'active', 'link' => '#'],
            ],
            'role' => $role,
        ];
        return view('admin.pages.roles.show', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Create Role',
            'sidebar_active' => 'roles',
            'breadcrumbs' => [
                ['text' => 'Home', 'status' => null, 'link' => route('admin.dashboard')],
                ['text' => 'Roles', 'status' => null, 'link' => route('admin.roles.index')],
                ['text' => 'Create', 'status' => 'active', 'link' => '#'],
            ],
        ];
        return view('admin.pages.roles.create', $data);
    }

    public function store(Request $request)
    {
        $request->merge([
            'slug' => Str::slug($request->input('name'))
        ]);
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required|unique:admin_roles,slug',
            'desc' => 'nullable',
        ]);

        $role = new AdminRole;
        $role->name = $request->input('name');
        $role->slug = $request->input('slug');
        $role->desc = $request->input('desc');
        $role->save();

        $role = AdminRole::where('slug', $request->input('slug'))->first();

        return redirect()
            ->route('admin.roles.show', ['id' => $role->id])
            ->with('type', 'success')
            ->with('message', 'create role successfull');
    }

    public function edit($id)
    {
        $role = AdminRole::findOrFail($id);

        $data = [
            'title' => 'Edit Role',
            'sidebar_active' => 'roles',
            'breadcrumbs' => [
                ['text' => 'Home', 'status' => null, 'link' => route('admin.dashboard')],
                ['text' => 'Roles', 'status' => null, 'link' => route('admin.roles.index')],
                ['text' => 'Edit', 'status' => 'active', 'link' => '#'],
            ],
            'role' => $role,
        ];
        return view('admin.pages.roles.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $role = AdminRole::findOrFail($id);

        if (!in_array($role->slug, $this->except_roles)) {
            $request->merge([
                'slug' => Str::slug($request->input('name'))
            ]);
        }
        $this->validate($request, [
            'name' => !in_array($role->slug, $this->except_roles) ? 'required' : 'nullable',
            'slug' => !in_array($role->slug, $this->except_roles) ? 'required' : 'nullable' . '|unique:admin_roles,slug,' . $id . ',id',
            'desc' => 'nullable',
        ]);

        if (!in_array($role->slug, $this->except_roles)) {
            $role->name = $request->input('name');
            $role->slug = $request->input('slug');
        }
        $role->desc = $request->input('desc');
        $role->save();

        return redirect()
            ->route('admin.roles.show', ['id' => $role->id])
            ->with('type', 'success')
            ->with('message', 'update role successfull');
    }

    public function destroy($id)
    {
        $role = AdminRole::findOrFail($id);

        if (in_array($role->slug, $this->except_roles)) {
            return redirect()
                ->back()
                ->with('type', 'danger')
                ->with('message', 'delete role failed, role ' . $role->name . ' cannot be deleted');
        }

        $role->delete();

        return redirect()
            ->route('admin.roles.index')
            ->with('type', 'success')
            ->with('message', 'delete role successfull');
    }
}

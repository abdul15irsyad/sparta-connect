<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use App\Models\AdminRole;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;


class AdminController extends Controller
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

        $data = AdminUser::with(['admin_role'])->orderBy('created_at', 'desc')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<div class="text-center">';
                $btn .= '<a href="' . route('admin.admins.show', ['id' => $row->id]) . '" class="btn btn-sm btn-transparent" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fas fa-fw fa-info-circle"></i></a>';
                $btn .= '<a href="' . route('admin.admins.edit', ['id' => $row->id]) . '" class="btn btn-sm btn-transparent" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-fw fa-pen"></i></a>';
                $btn .= '<button class="btn btn-sm btn-transparent btn-delete text-danger" data-toggle="tooltip" data-placement="top" title="Delete" data-name="' . $row->username . '" data-model="admin" data-link="' . route('admin.admins.destroy', ['id' => $row->id]) . '" data-toggle="modal" data-target=".modal-delete"><i class="fas fa-fw fa-trash-alt"></button>';
                $btn .= '</div>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function index()
    {
        $data = [
            'title' => 'Admins',
            'sidebar_active' => 'admins',
            'breadcrumbs' => [
                ['text' => 'Home', 'status' => null, 'link' => route('admin.dashboard')],
                ['text' => 'Admins', 'status' => 'active', 'link' => '#'],
            ],
        ];
        return view('admin.pages.admins.index', $data);
    }

    public function show($id)
    {
        $admin_user = AdminUser::with(['admin_role'])->findOrFail($id);

        $data = [
            'title' => 'Detail Admin',
            'sidebar_active' => 'admins',
            'breadcrumbs' => [
                ['text' => 'Home', 'status' => null, 'link' => route('admin.dashboard')],
                ['text' => 'Admins', 'status' => null, 'link' => route('admin.admins.index')],
                ['text' => 'Detail', 'status' => 'active', 'link' => '#'],
            ],
            'admin_user' => $admin_user,
        ];
        return view('admin.pages.admins.show', $data);
    }

    public function create()
    {
        $admin_roles = AdminRole::orderBy('name', 'asc')->get();
        $data = [
            'title' => 'Create Admin',
            'sidebar_active' => 'admins',
            'breadcrumbs' => [
                ['text' => 'Home', 'status' => null, 'link' => route('admin.dashboard')],
                ['text' => 'Admins', 'status' => null, 'link' => route('admin.admins.index')],
                ['text' => 'Create', 'status' => 'active', 'link' => '#'],
            ],
            'admin_roles' => $admin_roles,
        ];
        return view('admin.pages.admins.create', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'username' => 'required|min:3|regex:/^[a-z0-9\_]+$/|unique:admin_users,username',
            'email' => 'required|email|unique:admin_users,email',
            'password' => 'required|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])./',
            'confirm_password' => 'same:password',
            'role' => 'required|exists:admin_roles,slug',
        ]);

        $admin_role = AdminRole::where('slug', $request->input('role'))->first();

        $admin_user = new AdminUser;
        $admin_user->name = $request->input('name');
        $admin_user->username = $request->input('username');
        $admin_user->email = $request->input('email');
        $admin_user->password = Hash::make($request->input('password'));
        $admin_user->admin_role_id = $admin_role->id;
        $admin_user->save();

        $admin_user = AdminUser::where('username', $request->input('username'))->first();

        return redirect()
            ->route('admin.admins.show', ['id' => $admin_user->id])
            ->with('type', 'success')
            ->with('message', 'create admin successfull');
    }

    public function edit($id)
    {
        $admin_user = AdminUser::findOrFail($id);
        $admin_roles = AdminRole::orderBy('name', 'asc')->get();

        $data = [
            'title' => 'Edit Admin',
            'sidebar_active' => 'admins',
            'breadcrumbs' => [
                ['text' => 'Home', 'status' => null, 'link' => route('admin.dashboard')],
                ['text' => 'Admins', 'status' => null, 'link' => route('admin.admins.index')],
                ['text' => 'Edit', 'status' => 'active', 'link' => '#'],
            ],
            'admin_user' => $admin_user,
            'admin_roles' => $admin_roles,
        ];
        return view('admin.pages.admins.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $admin_user = AdminUser::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|min:3',
            'username' => 'required|min:3|regex:/^[a-z0-9\_]+$/|unique:admin_users,username,' . $id . ',id',
            'email' => 'required|email|unique:admin_users,email,' . $id . ',id',
            'password' => 'nullable|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])./',
            'confirm_password' => 'nullable|same:password',
            'role' => 'required|exists:admin_roles,slug',
        ]);

        $admin_role = AdminRole::where('slug', $request->input('role'))->first();
        $super_admins = AdminUser::whereHas('admin_role', fn ($query) => $query->where('slug', 'super-admin'))->get();
        if ($admin_user->admin_role->slug == 'super-admin' && $admin_role->slug != 'super-admin' && $super_admins->count() <= 1) {
            return redirect()
                ->back()
                ->withInput()
                ->with('type', 'danger')
                ->with('message', 'update admin failed, there is must be at least 1 super admin');
        }

        $admin_user->name = $request->input('name');
        $admin_user->username = $request->input('username');
        $admin_user->email = $request->input('email');
        if ($request->input('password') != '') {
            $admin_user->password = Hash::make($request->input('password'));
        }
        $admin_user->admin_role_id = $admin_role->id;
        $admin_user->status = $request->input('status');
        $admin_user->save();

        return redirect()
            ->route('admin.admins.show', ['id' => $admin_user->id])
            ->with('type', 'success')
            ->with('message', 'update admin successfull');
    }

    public function destroy($id)
    {
        $admin_user = AdminUser::findOrFail($id);

        $super_admins = AdminUser::whereHas('admin_role', fn ($query) => $query->where('slug', 'super-admin'))->get();
        if ($admin_user->admin_role->slug == 'super-admin' && $super_admins->count() <= 1) {
            return redirect()
                ->back()
                ->with('type', 'danger')
                ->with('message', 'delete admin failed, there is must be at least 1 super admin');
        }

        $admin_user->delete();

        return redirect()
            ->route('admin.admins.index')
            ->with('type', 'success')
            ->with('message', 'delete admin successfull');
    }
}

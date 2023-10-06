<?php

namespace App\Http\Controllers;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
//use DB;

class RoleController extends Controller
{
    
    function __construct()
    {
         $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
         $this->middleware('permission:role-create', ['only' => ['create','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $roles = Role::query();

            return DataTables::of($roles)
                ->addColumn('action', function ($role) {
                    $edit = route('roles.edit', $role->id);
                    $delete = route('roles.destroy', $role->id);
                    return '<a href="' . $edit . '" class="btn btn-primary">Edit</a>&nbsp;&nbsp;<a href="' . $delete . '" class="btn btn-danger delete">Delete</a>';
                })
                ->make(true);
        }

        return view('roles.index');
    }

    // Implement create, store, show, edit, update, and destroy methods

    public function create()
    {
        $permission = Permission::get();
        return view('roles.create',compact('permission'));
    }
    

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
    
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
    
        return redirect()->route('roles.index')
                        ->with('success','Role created successfully');
    }


   

}



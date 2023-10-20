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


   /* public function index(Request $request)
    {
        if ($request->ajax()) {
            $roles = Role::query();

            return DataTables::of($roles)
                ->addColumn('action', function ($role) {
                    //$edit = route('roles.edit', $role->id);
                    //$delete = route('roles.destroy', $role->id);
                    //return '<a href="' . $edit . '" class="btn btn-primary">Edit</a>&nbsp;&nbsp;<a href="' . $delete . '" class="btn btn-danger delete">Show</a>';
                    $editRoute = route('roles.edit', $role->id);
                    $showRoute = route('roles.show', $role->id);
                    $deleteRoute = route('roles.destroy', $role->id);
    
                    return '<a href="' . $editRoute . '" class="btn btn-primary">Edit</a>' .
                           '<a href="' . $showRoute . '" class="btn btn-success">View</a>' .
                           '<form method="POST" action="' . $deleteRoute . '" style="display:inline;">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('roles.index');
    }*/




  /*  public function index(Request $request)
{
    if ($request->ajax()) {
        $roles = Role::query();

        return DataTables::of($roles)
            ->addColumn('action', function ($role) {
                $editRoute = route('roles.edit', $role->id);
                $showRoute = route('roles.show', $role->id);
                $deleteRoute = route('roles.destroy', $role->id);

                $editButton = '';
                $showButton = '<a href="' . $showRoute . '" class="btn btn-success">View</a>';
                $deleteButton = '';

                // Check if the user has the 'role-edit' permission
                if (auth()->user()->can('role-edit')) {
                    $editButton = '<a href="' . $editRoute . '" class="btn btn-primary">Edit</a>';
                }

                // Check if the user has the 'role-delete' permission
                if (auth()->user()->can('role-delete')) {
                    $deleteButton = '<form method="POST" action="' . $deleteRoute . '" style="display:inline;">
                                     ' . csrf_field() . '
                                     ' . method_field('DELETE') . '
                                     <button type="submit" class="btn btn-danger">Delete</button>
                                   </form>';
                }

                // Combine the buttons
                return $editButton . $showButton . $deleteButton;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    return view('roles.index');
}
*/
/*public function index(Request $request)
{
    if ($request->ajax()) {
        $roles = Role::query();

        return DataTables::of($roles)
            ->addColumn('action', function ($role) {
                $editRoute = route('roles.edit', $role->id);
                $showRoute = route('roles.show', $role->id);
                $deleteRoute = route('roles.destroy', $role->id);

                // Check if the user has the 'role-edit' permission
                if (auth()->user()->can('role-edit')) {
                    $editButton = '<a href="' . $editRoute . '" class="btn btn-primary">Edit</a>';
                } else {
                    $editButton = ''; // No permission, don't display the 'Edit' button
                }

                // Always show the "Show" button
                $showButton = '<a href="' . $showRoute . '" class="btn btn-success">View</a>';

                // Check if the user has the 'role-delete' permission
                if (auth()->user()->can('role-delete')) {
                    $deleteButton = '<form method="POST" action="' . $deleteRoute . '" style="display:inline;">
                                    ' . csrf_field() . '
                                    ' . method_field('DELETE') . '
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>';
                } else {
                    $deleteButton = ''; // No permission, don't display the 'Delete' button
                }

                // Combine the buttons
                return $editButton . $showButton . $deleteButton;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    return view('roles.index');
}
*/

/*public function index(Request $request)
{
    if ($request->ajax()) {
        $roles = Role::query();

        return DataTables::of($roles)
            ->addColumn('action', function ($role) {
                $editRoute = route('roles.edit', $role->id);
                $showRoute = route('roles.show', $role->id);
                $deleteRoute = route('roles.destroy', $role->id);

                // Check if the user has the 'role-edit' permission
                if (auth()->user()->can('role-edit')) {
                    $editButton = '<a href="' . $editRoute . '" class="btn btn-primary">Edit</a>';
                } else {
                    $editButton = ''; // No permission, don't display the 'Edit' button
                }

                // Always show the "Show" button
                $showButton = '<a href="' . $showRoute . '" class="btn btn-success">View</a>';

                // Check if the user has the 'role-delete' permission
                if (auth()->user()->can('role-delete')) {
                    $deleteButton = '<form method="POST" action="' . $deleteRoute . '" style="display:inline;">
                                    ' . csrf_field() . '
                                    ' . method_field('DELETE') . '
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>';
                } else {
                    $deleteButton = ''; // No permission, don't display the 'Delete' button
                }

                // Combine the buttons
                return $editButton . $showButton . $deleteButton;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    return view('roles.index');
}

*/

public function index(Request $request)
{
    if ($request->ajax()) {
        $roles = Role::query();

        return DataTables::of($roles)
            ->addColumn('action', function ($role) {
                $editRoute = route('roles.edit', $role->id);
                $showRoute = route('roles.show', $role->id);
                $deleteRoute = route('roles.destroy', $role->id);

                // Check if the user has the 'role-edit' permission
                if (auth()->user()->can('role-edit')) {
                    $editButton = '<a href="' . $editRoute . '" class="btn btn-primary">Edit</a>';
                } else {
                    $editButton = ''; // No permission, don't display the 'Edit' button
                }

                // Always show the "Show" button
                $showButton = '<a href="' . $showRoute . '" class="btn btn-success">View</a>';

                // Check if the user has the 'role-delete' permission
                $deleteButton = '';
                if (auth()->user()->can('role-delete')) {
                    $deleteButton = '<form method="POST" action="' . $deleteRoute . '" style="display:inline;">
                                    ' . csrf_field() . '
                                    ' . method_field('DELETE') . '
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>';
                }

                // Combine the buttons
                return $editButton . $showButton . $deleteButton;
            })
            ->rawColumns(['action'])
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


    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();
    
        return view('roles.show',compact('role','rolePermissions'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
    
        return view('roles.edit',compact('role','permission','rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
    
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();
    
        $role->syncPermissions($request->input('permission'));
    
        return redirect()->route('roles.index')
                        ->with('success','Role updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('roles.index')
                        ->with('success','Role deleted successfully');
    }

}



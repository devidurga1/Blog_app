<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Arr;
use Illuminate\Support\HtmlString;
class UserController extends Controller




{
 

/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   /* public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('*');
            return DataTables ::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                           $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('users');
    }*/
//this right code

   public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::orderBy('created_at', 'desc')->select(['id', 'name', 'email', 'created_at']);

            return Datatables::of($users)
                ->addColumn('action', function ($user) {
                    $edit = route('users.edit', $user->id);
                    $show = route('users.show', $user->id);
                    $delete = route('users.destroy', $user->id);
                    return '<a href="' . $edit . '" class="btn btn-primary">Edit</a>&nbsp;&nbsp;<a href="' . $show . '" class="btn btn-info">Show</a>&nbsp;&nbsp;<a href="' . $delete . '" class="btn btn-danger delete">Delete</a>';
                })
                ->make(true);
        }

        return view('users.index');
    }



/*public function index(Request $request)
    {
        if ($request->ajax()) {
            $roles = Role::all();

    // Query to fetch users with filtering
    $users = User::query();
    $users->with(['roles']);
            $users = User::select(['id', 'name', 'email', 'created_at'])
                ->orderBy('created_at', 'desc');

            if ($request->has('name') && $request->input('name')) {
                $users->where('name', 'like', '%' . $request->input('name') . '%');
            }

            if ($request->has('email') && $request->input('email')) {
                $users->where('email', 'like', '%' . $request->input('email') . '%');
            }
            return Datatables::of($users)
                ->addColumn('action', function ($user) {
                    $edit = route('users.edit', $user->id);
                    $show = route('users.show', $user->id);
                    $delete = route('users.destroy', $user->id);
                    return '<a href="' . $edit . '" class="btn btn-primary">Edit</a>&nbsp;&nbsp;<a href="' . $show . '" class="btn btn-info">Show</a>&nbsp;&nbsp;<a href="' . $delete . '" class="btn btn-danger delete">Delete</a>';
                })
                ->make(true);
        }

        return view('users.index');
    }
*/
   

  /* public function index(Request $request)
 {
    $roles = Role::all(); // Fetch all roles for the dropdown

    if ($request->ajax()) {
        $query = User::query()
            ->with('role')
            ->select('users.*');

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->has('email')) {
            $query->where('email', 'like', '%' . $request->input('email') . '%');
        }

        if ($request->has('role')) {
            $query->whereHas('role', function ($q) use ($request) {
                $q->where('id', $request->input('role'));
            });
        }

        return DataTables::of($query)
            ->addColumn('actions', function ($user) {
                $editUrl = route('users.edit', $user->id);
                $showUrl = route('users.show', $user->id);
                $deleteUrl = route('users.destroy', $user->id);

                return new HtmlString(
                    "<a href=\"$editUrl\" class=\"btn btn-warning btn-sm\">Edit</a>
                     <a href=\"$showUrl\" class=\"btn btn-info btn-sm\">Show</a>
                     <form method=\"POST\" action=\"$deleteUrl\" class=\"d-inline\">
                         @csrf
                         @method('DELETE')
                         <button type=\"submit\" class=\"btn btn-danger btn-sm\" onclick=\"return confirm('Are you sure?')\">Delete</button>
                     </form>"
                );
            })
            ->make(true);
    }

    return view('users.index', compact('roles'));
}
*/



/*public function index(Request $request)
{
    $roles = Role::all(); // Fetch all roles for the dropdown

    if ($request->ajax()) {
        $query = User::query()
            ->with('role')
            ->select('users.*');

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->has('email')) {
            $query->where('email', 'like', '%' . $request->input('email') . '%');
        }

        if ($request->has('role')) {
            $query->whereHas('role', function ($q) use ($request) {
                $q->where('id', $request->input('role'));
            });
        }

        return DataTables::of($query)
            ->addColumn('actions', function ($user) {
                $editUrl = route('users.edit', $user->id);
                $showUrl = route('users.show', $user->id);
                $deleteUrl = route('users.destroy', $user->id);

                return new HtmlString(
                    "<a href=\"$editUrl\" class=\"btn btn-warning btn-sm\">Edit</a>
                     <a href=\"$showUrl\" class=\"btn btn-info btn-sm\">Show</a>
                     <form method=\"POST\" action=\"$deleteUrl\" class=\"d-inline\">
                         @csrf
                         @method('DELETE')
                         <button type=\"submit\" class=\"btn btn-danger btn-sm\" onclick=\"return confirm('Are you sure?')\">Delete</button>
                     </form>"
                );
            })
            ->make(true);
    }
    return view('users.index', compact('roles'));
}*/










public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }


    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('users.edit',compact('user','roles','userRole'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }
    

 }


    









   



        

    




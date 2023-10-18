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
 
    function __construct()
    {
         $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

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

   /*public function index(Request $request)
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




/*public function index(Request $request)
{
    $roles = Role::all();

    if ($request->ajax()) {
        $query = User::query()
            ->with('roles') // Eager load the 'roles' relationship
            ->orderBy('created_at', 'desc');

        if ($request->input('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->input('email')) {
            $query->where('email', 'like', '%' . $request->input('email') . '%');
        }

        if ($request->input('role')) {
            $query->whereHas('roles', function ($q) use ($request) {
                $q->where('name', $request->input('role'));
            });
        }

        return DataTables()->eloquent($query)
            ->addColumn('roles', function (User $user) {
                return $user->roles->implode('name', ', ');
            })
            ->addColumn('action', function (User $user) {
                $deleteRoute = route('users.destroy', $user->id);
                $confirmationMessage = "Are you sure you want to delete this user?";
                $deleteScript = <<<SCRIPT
                    <form method="POST" action="{$deleteRoute}" style="display:inline;">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="button" class="btn btn-danger delete-button">Delete</button>
                    </form>
                    <script>
                        document.querySelector('.delete-button').addEventListener('click', function() {
                            if (confirm('{$confirmationMessage}')) {
                                this.parentNode.submit();
                            }
                        });
                    </script>
                SCRIPT;
                return $deleteScript;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    return view('users.index', compact('roles'));
}
*/



public function index(Request $request)
{
    $roles = Role::all();

    if ($request->ajax()) {
        $query = User::query()
            ->with('roles')
            ->orderBy('created_at', 'desc');

        if ($request->input('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->input('email')) {
            $query->where('email', 'like', '%' . $request->input('email') . '%');
        }

        if ($request->input('role')) {
            $query->whereHas('roles', function ($q) use ($request) {
                $q->where('name', $request->input('role'));
            });
        }

        return DataTables()->eloquent($query)
            ->addColumn('roles', function (User $user) {
                return $user->roles->implode('name', ', ');
            })
            ->addColumn('action', function (User $user) {
                $editRoute = route('users.edit', $user->id);
                $showRoute = route('users.show', $user->id);
                $deleteRoute = route('users.destroy', $user->id);

                return '<a href="' . $editRoute . '" class="btn btn-primary">Edit</a>' .
                    '<a href="' . $showRoute . '" class="btn btn-success">Show</a>' .
                    '<button data-id="' . $user->id . '" class="btn btn-danger delete-button">Delete</button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    if ($request->isMethod('delete')) {
        $userId = $request->input('user_id');
        dd($userId);
        // Perform the actual deletion of the user here, for example:
        User::destroy($userId);
        
        // Return a response indicating success
        return response()->json(['message' => 'User deleted successfully']);
    }

    return view('users.index', compact('roles'));
}







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
            'password' => 'required',
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


    /*public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('users.edit',compact('user','roles','userRole'));
    }
    */


    public function edit($id)
{
    $user = User::find($id); // Fetch the user from the database
    $roles = Role::all(); // You should fetch the available roles

    return view('users.edit', compact('user', 'roles'));
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   /* public function update(Request $request, $id)
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
    }*/

   /* public function update(Request $request, User $user)
    {
        //dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            //'is_admin'=>'required|boolean',

            // 'password' => 'required|string|min:6',
            'roles' => 'required|array'
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        } else {
            unset($input['image']);
        }
        $user->update($input);
        $user->roles()->sync($request->input('roles'));
        return redirect()->route('users.index')->with('success', 'User update successfully');
    }*/

    public function update(Request $request, User $user)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        //'is_admin'=>'required|boolean',

        // 'password' => 'required|string|min:6',
        'role' => 'required|exists:roles,id', // Validate the single role ID
    ]);

    $input = $request->all();

    if ($image = $request->file('image')) {
        $destinationPath = 'images/';
        $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
        $image->move($destinationPath, $profileImage);
        $input['image'] = "$profileImage";
    } else {
        unset($input['image']);
    }

    $user->update($input);

    // Sync the roles with the selected role only, instead of all roles
    $user->roles()->sync([$request->input('role')]);

    return redirect()->route('users.index')->with('success', 'User updated successfully');
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


    









   



        

    




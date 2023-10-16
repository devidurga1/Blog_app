<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class RoleUserController extends Controller
{
    public function registerView()
    {
        return view('RoleUser.register');

    }

    public function register(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users|email',
            'password' => 'required|string|min:6|confirmed'

        ]);
        // dd($request->all());
 $user = User::create([

            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)

        ]);
        // Assign the "admin" role to the newly registered user
    $adminRole = Role::where('name', 'user')->first();
    if ($adminRole) {
        $user->assignRole($adminRole);
    }

    $request->validate([
        'email' => 'required',
        'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
        return redirect()->intended('userdashboard')
                    ->withSuccess('You have Successfully loggedin');
    }
        //return redirect('dashboard')->withSuccess('Great! You have Successfully loggedin');
    
    }

    public function dashboard()
    {
        if(Auth::check()){
            return view('RoleUser.userdashboard');
        }
  
        return redirect("login")->withSuccess('Opps! You do not have access');
    }
}

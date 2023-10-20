<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Notifications\WelcomeMailNotification;

use App\Providers\RouteServiceProvider;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;

class RoleUserController extends Controller
{
    public function RegisterView()
    {
        return view('userview.userregister');

    }

    public function Register(Request $request)
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

       
       // Mail::to($user->email)->send(new WelcomeEmail($user));
    

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
        return redirect()->intended('viewall')
                    ->withSuccess('You have Successfully loggedin');
    }
        //return redirect('dashboard')->withSuccess('Great! You have Successfully loggedin');
    
    }

    public function dashboard()
    {
        if(Auth::check()){
            return view('RoleUser.userdashboard');
        }
  
        return redirect("login1")->withSuccess('Opps! You do not have access');
    }

//
public function index()
    {
        return view('userview.userlogin');
    }



    public function Login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('viewall')
                        ->withSuccess('You have Successfully loggedin');
        }
  
        return redirect("userlogin")->withSuccess('Oppes! You have entered invalid credentials');
    }

    public function viewall()
    {
        $posts = Post::with('comments')->get(); // Load only the "comments" relationship
        return view('userview.viewall', ['posts' => $posts]);
    }


    public function show($id)
    {
        // Retrieve the specific post
        $post = Post::findOrFail($id);

        // Retrieve comments associated with the post, along with their users
        $comments = Comment::where('post_id', $id)->with('user')->get();

        // Return the view with the post and comments data
        return view('userview.viewdetail', compact('post', 'comments'));
    }
   
   
public function logout() {
    Session::flush();
    Auth::logout();

    return Redirect('viewuser.userregister');
}


}

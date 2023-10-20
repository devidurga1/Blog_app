<?php


namespace App\Http\Controllers;
    
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Session;

  

class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return socialite::driver('google')->redirect();
    }
        
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
    
            $user = Socialite::driver('google')->user();
       
            $finduser = User::where('google_id', $user->id)->first();
       
            if($finduser){
       
                Auth::login($finduser);
      
                return redirect()->intended('viewall');
       
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => Str::random(16)
                ]);
      
                Auth::login($newUser);
      
                return redirect()->intended('viewall');
            }
      
        } 

        
        
        catch (Exception $e) {
           // dd($e->getMessage());
           return redirect('userlogin')->with('error', 'Google login failed: ' . $e->getMessage());
        }
    }
}

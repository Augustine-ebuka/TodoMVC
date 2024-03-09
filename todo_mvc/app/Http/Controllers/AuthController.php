<?php
 
namespace App\Http\Controllers;
 
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
 
class AuthController extends Controller
{
    public function register()
    {
        return view('register');
    }
 
    public function registerPost(Request $request)
    {
        $user = new User();
 
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
 
        $user->save();
        
        return response()->json(['message'=>"success",'user'=>$user]);
      
    }
 
    public function login()
    {
        return view('login');
    }
 

    public function loginPost(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return response()->json(['message' => 'Login success', 'user' => $user]);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

 
    public function logout()
    {
        Auth::logout();
 
        return response()->json(['message' => 'Logout success']);
    }
}
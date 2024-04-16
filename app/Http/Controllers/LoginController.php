<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
class LoginController extends Controller
{
    public function login(Request $request){
        if ($request->isMethod('POST')) {
            if (Auth::attempt(['email'=>$request->email,'password'=>$request->password])){ 
                return redirect('/admin');;
        }else{
            //Đăng nhập không thành công
            Session::flash('error','Sai mật khẩu');
            return redirect()->route('login');
        }
    }
    return view('auth.login');
    }
    public function logout(){
        Auth::logout();
        return redirect('/')->with('success','Đăng xuất thành công');
    }

    public function register(Request $request)
    {
        if ($request->isMethod('POST')) {
            // $validatedData = $request->validate([
            //     'name' => 'required|string|max:255',
            //     'email' => 'required|string|email|max:255|unique:users',
            //     'password' => 'required|string|min:8|confirmed',
            // ]);
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->address =$request->address;
            $user->phone =$request->phone;
            $user->password = Hash::make($request->password);
            $user->save();
            // dd($user);
            Auth::login($user);
    
            return redirect('/login')->with('success', 'Đăng ký thành công!'); // Chuyển hướng người dùng về trang đăng nhập
        }
    
        return view('auth.register');
    }
    public function log(){
        Auth::logout();
        return redirect('/login')->with('success','Đăng xuất thành công');
    }
}

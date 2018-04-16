<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class SessionsController extends Controller
{
    //Create
    public function create(){
        return view('sessions.create');
    }
    //Login
    public function store(Request $request){
        $credentials = $this->validate($request,[
            'email'=>'required|email|max:255',
            'password'=>'required',
        ]);
        if(Auth::attempt($credentials,$request->has('remember'))){
            //登录成功的相关操作
            session()->flash('success','欢迎回来！');
            return redirect()->route('users.show',[Auth::user()]);
        }else{
            //登录失败的相关操作
            session()->flash('danger','很抱歉，您输入的邮箱或密码不正确');
            return redirect()->back();
        }
    }
    //Loginout
    public function destroy(){
        Auth::logout();
        session()->flash('success','您已成功退出页面');
        return redirect('/');

    }
}

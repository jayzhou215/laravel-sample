<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SessionController extends Controller
{

    public function __construct()
    {
      $this->middleware('guest', [
        'only' => 'create'
      ]);
    }

    public function create()
    {
      return view('sessions.create');
    }

    public function store(Request $request)
    {
      $this->validate($request, [
        'email' => 'required|email|max:255',
        'password' => 'required'
      ]);
      if (Auth::attempt([
        'email' => $request->email,
        'password' => $request->password
      ], $request->has('remember'))) {
        // 该用户存在于数据库，且邮箱和密码相符合
        session()->flash('success', '欢迎回来！');
        return redirect()->intended(route('users.show', [Auth::user()]));
      } else {
        session()->flash('danger', '很抱歉，您的邮箱和密码不匹配');
        return redirect()->back();
      }
    }

    public function destroy()
    {
      Auth::logout();
      session()->flash('success', '您已成功退出！');
      return redirect('login');
    }


}

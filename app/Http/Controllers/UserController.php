<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    public function show($id)
    {
      $user = User::findOrFail($id);
      return view('user.show', compact('user'));
    }

    public function store(Request $request)
    {
      $this->validate($request, [
        'name' => 'required|min:3|max:50',
        'email' => 'required|email|unique:users|max:255',
        'password' => 'required'
      ]);
      $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password
      ]);
      Auth::login($user);
      session()->flash('success', '欢迎，您将在这里开启一段新的旅程~');
      return redirect()->route('users.show', [$user]);
    }
}

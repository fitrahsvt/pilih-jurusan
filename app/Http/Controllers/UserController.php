<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        return view('user.index', compact('users'));
    }

    public function create()
    {
        $role = Role::all();
        return view('user.create', compact('role'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'role' => 'required',
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $user = User::create([
            'role_id' => $request->role,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password,
        ]);
        return redirect()->route('user.index');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $role = Role::all();
        return view('user.edit', compact('user', 'role'));
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(),[
            'role' => 'required',
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }


        User::where('id', $id)->update([
            'role_id' => $request->role,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password,
        ]);
        return redirect()->route('user.index');
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect()->route('user.index');
    }
}

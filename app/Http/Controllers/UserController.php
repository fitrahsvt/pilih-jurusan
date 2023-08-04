<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Rules\MixedLetterNumber;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'name' => 'required|string|min:6',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'string', 'min:8', new MixedLetterNumber],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => 1,
        ]);
        return redirect()->route('user.index');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(),[
            'name' => 'required|string|min:6',
            'email' => 'required|email',
            'password' => ['required', 'string', 'min:8', new MixedLetterNumber],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => 1,
        ]);
        return redirect()->route('user.index');
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect()->route('user.index');
    }
}

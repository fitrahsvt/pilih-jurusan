<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function adduser()
    {
        return view('user.add-user');
    }

    public function detailuser()
    {
        return view('user.detail-user');
    }

    public function edituser(){
        return view('user.edit-user');
    }

    public function produk()
    {
        $nama = "Laptop";
        return view('user.product', ['nama' => $nama]);
    }
}

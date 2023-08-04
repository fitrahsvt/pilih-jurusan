<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FoodController extends Controller
{
    public function index()
    {
        $food = Food::all();
        return view('food.index', compact('food'));
    }

    public function create()
    {
        return view('food.create');
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'price' => 'required|integer',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        //masukkan data ke database
        $food = Food::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        // redirect ke halaman food.index
        return redirect()->route('food.index');
    }

    public function edit($id)
    {
        $food = Food::find($id);
        return view('food.edit', compact('food'));
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'price' => 'required|integer',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        Food::where('id', $id)->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ]);
        return redirect()->route('food.index');
    }

    public function destroy($id)
    {
        Food::where('id', $id)->delete();
        return redirect()->route('food.index');
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FoodController extends Controller
{
    public function index()
    {
        $foodcount = Food::all()->count();
        $foods = Food::select('id', 'name', 'price', 'description')->get();
        $foods = $foods->map(function ($food) {
            $food->links = ['self' => 'http://pilih-jurusan.test/api/food/' . $food->id];
            return $food;
        });

        if($foods){
            return response()->json([
                'success' => true,
                'total' => $foodcount,
                'retrieved' => true,
                'data' => $foods,
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'The given food resource is not found.',
                'data' => ''
            ], 404);
        }
    }

    public function show($id)
    {
        $foods = Food::select('id', 'name', 'price', 'description')->find($id);

        if ($foods) {
            $foods->links = ['self' => url("http://pilih-jurusan.test/api/food/{$id}")];
            return response()->json([
                $foods
            ], 200);
        }else{
            return response()->json([
            'message'=> 'The given food resource is not found.'
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'price' => 'required|integer',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'The given data was invalid.',
                'data' => $validator->errors()
            ], 422);
        }

        $food = new Food;
        $food->name = $request->input('name');
        $food->price = $request->input('price');
        $food->description = $request->input('description');
        $food->save();
        $foods = Food::select('id', 'name', 'price', 'description')->find($food->id);

        $foods->links = ['self' => url("http://pilih-jurusan.test/api/food/{$foods->id}")];


        return response()->json([
            'message' => 'Food added successfully',
            'data' => $foods
        ], 201);

    }

    public function update(Request $request, $id)
    {
        $food = Food::find($id);
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'price' => 'required|integer',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'The given data was invalid.',
                'data' => $validator->errors()
            ], 422);
        }

        if ($food) {
            $foods = $food->update([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
            ]);
            $foods = Food::select('id', 'name', 'price', 'description')->find($id);
            $foods->links = ['self' => url("http://pilih-jurusan.test/api/food/{$id}")];

            return response()->json([
                'success' => true,
                'message' => 'Food update successfully',
                'data' => $foods
            ], 200);

        }else {
            return response()->json([
                'message'=> 'The given food resource is not found.'
            ], 404);
        }
    }

    public function destroy($id)
    {
        $food = Food::find($id);

        if ($food) {
            $food->delete();

            return response()->json([
                'success' => true,
                'message' => 'Food removed successfully',
                'data' => null
            ], 200);
        } else {
            return response()->json([
                'message'=> 'The given food resource is not found.'
                ], 404);
        }
    }

}

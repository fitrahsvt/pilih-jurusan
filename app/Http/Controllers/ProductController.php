<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();

        return view('product.index', compact('products'));
    }

    public function create()
    {
        $category = Category::all();
        $brand = Brand::all();
        return view('product.create', compact('category', 'brand'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'category' => 'required',
            'name' => 'required|string|min:3',
            'price' => 'required|integer',
            'sale_price' => 'required|integer',
            'brand' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,jfif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        // ubah nama file gambar dengan angka random
        $imageName = time().'.'.$request->image->extension();

        // upload file gambar ke folder slider
        Storage::putFileAs('public/product', $request->file('image'), $imageName);

        //masukkan data ke database
        $products = Product::create([
            'category_id' => $request->category,
            'name' => $request->name,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'brands' => $request->brand,
            'image' => $imageName,
        ]);
        // redirect ke halaman category.index
        return redirect()->route('product.index');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $category = Category::all();
        $brand = Brand::all();
        return view('product.edit', compact('category', 'brand', 'product'));
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(),[
            'category' => 'required',
            'name' => 'required|string|min:3',
            'price' => 'required|integer',
            'sale_price' => 'required|integer',
            'brand' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,jfif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        if ($request->hasFile('image')) {
            // ambil nama file gambar lama dari database
            $gambar_lama = Product::find($id)->image;

            //hapus file gambar lama
            Storage::delete('public/product/'.$gambar_lama);

            // ubah nama file gambar dengan angka random
            $imageName = time().'.'.$request->image->extension();

            // upload file gambar ke folder slider
            Storage::putFileAs('public/product', $request->file('image'), $imageName);

            //masukkan data ke database
            Product::where('id', $id)->update([
                'category_id' => $request->category,
                'name' => $request->name,
                'price' => $request->price,
                'sale_price' => $request->sale_price,
                'brands' => $request->brand,
                'image' => $imageName,
            ]);
        }else{
            Product::where('id', $id)->update([
                'category_id' => $request->category,
                'name' => $request->name,
                'price' => $request->price,
                'sale_price' => $request->sale_price,
                'brands' => $request->brand,
            ]);
        }
        return redirect()->route('product.index');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        Storage::delete('public/product/'.$product->image);

        Product::where('id', $id)->delete();
        return redirect()->route('product.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('slider.create');
    }

    public function store(Request $request)
    {
        // ubah nama file gambar dengan angka random
        $imageName = time().'.'.$request->image->extension();

        // upload file gambar ke folder slider
        Storage::putFileAs('public/slider', $request->file('image'), $imageName);

        // insert data ke table sliders
        $slider = Slider::create([
            'title' => $request->title,
            'caption' => $request->caption,
            'image' => $imageName,
        ]);

        // alihkan halaman ke halaman slider.index
        return redirect()->route('slider.index');
    }

    public function edit($id)
    {
        // cari data berdasarkan id menggunakan find()
        $slider = Slider::find($id);

        return view('slider.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        //cek upload gambar
        if ($request->hasFile('image')) {
            // ambil nama file gambar lama dari database
            $gambar_lama = Slider::find($id)->image;

            //hapus file gambar lama
            Storage::delete('public/slider/'.$gambar_lama);

            //ubah nama file baru
            $imageName = time().'.'.$request->image->extension();

            //upload
            Storage::putFileAs('public/slider', $request->file('image'), $imageName);

            //update data
            Slider::where('id', $id)->update([
                'title' => $request->title,
                'caption' => $request->caption,
                'image' => $imageName,
            ]);
        } else {
            Slider::where('id', $id)->update([
                'title' => $request->title,
                'caption' => $request->caption,
            ]);
        }

        return redirect()->route('slider.index');
    }

    public function destroy($id)
    {
        $slider = Slider::find($id);

        Storage::delete('public/slider/'.$slider->image);

        $slider->delete();

        return redirect()->route('slider.index');
    }
}

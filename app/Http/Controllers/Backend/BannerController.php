<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\frontend\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::latest()->get();
        return view('backend.banner.index', compact('banners'));
    }

    public function create()
    {
        return view('backend.banner.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048', // max 2MB
        ]);

        $image = $request->file('image');

        $filename = time() . '.webp';
        $path = 'banner/' . $filename;

        // resize + compress using Intervention Image Facade
        $img = Image::read($image)
            ->scale(width: 1920)
            ->toWebp(quality: 80);

        Storage::disk('public')->put($path, $img);

        Banner::create([
            'image' => $path,
            'is_active' => false
        ]);

        return redirect()->route('admin.banner.index')->with('success', 'Banner berhasil ditambahkan');
    }

    public function destroy(Banner $banner)
    {
        Storage::disk('public')->delete($banner->image);
        $banner->delete();

        return back()->with('success', 'Banner dihapus');
    }

    // TOGGLE AKTIF
    public function toggle(Banner $banner)
    {
        // nonaktifkan semua
        Banner::query()->update(['is_active' => 0]);

        // aktifkan yang dipilih
        $banner->update(['is_active' => 1]);

        return back()->with('success', 'Banner diaktifkan');
    }
}

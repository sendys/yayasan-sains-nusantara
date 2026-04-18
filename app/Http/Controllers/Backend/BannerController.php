<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\frontend\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;

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
        try {
            $validated = $request->validate([
                'image' => 'required|image|max:2048|mimes:jpeg,png,gif,webp',
                'cropData' => 'required|json',
            ], [
                'image.required' => 'Gambar harus dipilih',
                'image.image' => 'File harus berupa gambar',
                'image.max' => 'Ukuran gambar minimal dibawah 2MB',
                'image.mimes' => 'Format gambar harus JPEG, PNG, GIF, atau WebP',
                'cropData.required' => 'Data crop tidak ditemukan',
                'cropData.json' => 'Format data crop tidak valid',
            ]);

            $image = $request->file('image');
            $cropData = json_decode($request->input('cropData'), true);

            // Validasi crop data
            if (!isset($cropData['x'], $cropData['y'], $cropData['width'], $cropData['height'])) {
                return back()->withErrors(['image' => 'Data crop tidak lengkap'])->withInput();
            }

            $filename = time() . '.webp';
            $path = 'banner/' . $filename;

            // Create image manager with GD driver
            $manager = new ImageManager(new GdDriver());

            // Read & crop image
            $img = $manager->read($image)
                ->crop(
                    (int) $cropData['width'],
                    (int) $cropData['height'],
                    (int) $cropData['x'],
                    (int) $cropData['y']
                )
                ->scale(width: 1920)
                ->toWebp(quality: 80);

            Storage::disk('public')->put($path, $img);

            Banner::create([
                'image' => $path,
                'is_active' => false
            ]);

            return redirect()->route('admin.banner.index')->with('success', 'Banner berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()
                ->withErrors(['image' => 'Gagal memproses gambar: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function destroy(Banner $banner)
    {
        try {
            Storage::disk('public')->delete($banner->image);
            $banner->delete();

            return back()->with('success', 'Banner berhasil dihapus');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menghapus banner']);
        }
    }

    public function toggle(Banner $banner)
    {
        try {
            Banner::query()->update(['is_active' => 0]);
            $banner->update(['is_active' => 1]);

            return back()->with('success', 'Banner berhasil diaktifkan');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal mengaktifkan banner']);
        }
    }
}

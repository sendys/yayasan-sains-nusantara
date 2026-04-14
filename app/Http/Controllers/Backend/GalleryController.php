<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::orderBy('created_at', 'desc')->paginate(10);
        return view('backend.gallery.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoriList = Gallery::getKategoriList();
        return view('backend.gallery.create', compact('kategoriList'));
    }

    /**
     * Store a newly created resource in storage.
     */
        public function store(Request $request)
    {
        // Check file size before validation (2MB = 2097152 bytes)
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $maxSize = 2 * 1024 * 1024; // 2MB in bytes
            
            if ($file->getSize() > $maxSize) {
                $fileSizeMB = round($file->getSize() / (1024 * 1024), 2);
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'status' => 'error',
                        'message' => "Ukuran gambar ({$fileSizeMB}MB) melebihi batas maksimal 2MB.",
                        'errors' => ['image' => "Ukuran gambar ({$fileSizeMB}MB) melebihi batas maksimal 2MB."],
                    ], 422);
                }
                return redirect()->back()
                    ->with('error', "Ukuran gambar ({$fileSizeMB}MB) melebihi batas maksimal 2MB.")
                    ->withInput();
            }
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'kategori' => 'required|in:sosialisasi,kunjungan,pelatihan,seminar,workshop,lainnya',
            'is_active' => 'nullable|boolean',
        ], [
            'title.required' => 'Judul galeri wajib diisi',
            'title.max' => 'Judul maksimal 255 karakter',
            'image.image' => 'File harus berupa gambar',
            'image.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau webp',
            'image.max' => 'Ukuran gambar maksimal 2MB',
            'kategori.required' => 'Kategori wajib dipilih',
            'kategori.in' => 'Kategori tidak valid',
        ]);

        if ($validator->fails()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors(),
                ], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = $validator->validated();

            // Handle image upload
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $data['image'] = $file->storeAs('galleries', $filename, 'public');
            }

            // Handle is_active checkbox
            $data['is_active'] = $request->has('is_active');

            $gallery = Gallery::create($data);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Galeri berhasil dibuat.',
                    'data' => $gallery
                ], 201);
            }
            return redirect()->route('admin.gallery.index')->with('success', 'Galeri berhasil dibuat.');
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan saat menyimpan data.',
                ], 500);
            }
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($uuid)
    {
        $gallery = Gallery::where('uuid', $uuid)->first();

        if (!$gallery) {
            if (request()->ajax() || request()->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Galeri tidak ditemukan.'
                ], 404);
            }
            return redirect()->back()->with('error', 'Galeri tidak ditemukan.');
        }

        return view('backend.gallery.show', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uuid)
    {
        $gallery = Gallery::where('uuid', $uuid)->first();

        if (!$gallery) {
            return redirect()->back()->with('error', 'Galeri tidak ditemukan.');
        }

        $kategoriList = Gallery::getKategoriList();
        return view('backend.gallery.edit', compact('gallery', 'kategoriList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        $gallery = Gallery::where('uuid', $uuid)->first();

        if (!$gallery) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Galeri tidak ditemukan.'
                ], 404);
            }
            return redirect()->back()->with('error', 'Galeri tidak ditemukan.');
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'kategori' => 'required|in:sosialisasi,kunjungan,pelatihan,seminar,workshop,lainnya',
            'is_active' => 'nullable|boolean',
        ], [
            'title.required' => 'Judul galeri wajib diisi',
            'title.max' => 'Judul maksimal 255 karakter',
            'image.image' => 'File harus berupa gambar',
            'image.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau webp',
            'image.max' => 'Ukuran gambar maksimal 2MB',
            'kategori.required' => 'Kategori wajib dipilih',
            'kategori.in' => 'Kategori tidak valid',
        ]);

        if ($validator->fails()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors(),
                ], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = $validator->validated();

            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
                    Storage::disk('public')->delete($gallery->image);
                }

                $file = $request->file('image');
                $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $data['image'] = $file->storeAs('galleries', $filename, 'public');
            }

            // Handle is_active checkbox
            $data['is_active'] = $request->has('is_active');

            $gallery->update($data);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Galeri berhasil diupdate.',
                    'data' => $gallery->fresh()
                ]);
            }
            return redirect()->route('admin.gallery.index')->with('success', 'Galeri berhasil diupdate.');
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan saat mengupdate data.',
                ], 500);
            }
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengupdate data.')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        $gallery = Gallery::where('uuid', $uuid)->first();

        if (!$gallery) {
            if (request()->ajax() || request()->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Galeri tidak ditemukan.'
                ], 404);
            }
            return redirect()->back()->with('error', 'Galeri tidak ditemukan.');
        }

        try {
            // Delete image file if exists
            if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
                Storage::disk('public')->delete($gallery->image);
            }

            $gallery->delete();

            if (request()->ajax() || request()->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Galeri berhasil dihapus.'
                ]);
            }
            return redirect()->route('admin.gallery.index')->with('success', 'Galeri berhasil dihapus.');
        } catch (\Exception $e) {
            if (request()->ajax() || request()->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan saat menghapus data.',
                ], 500);
            }
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }
}
<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->paginate(10);
        return view('backend.blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'author' => 'nullable|string|max:100',
            'status' => 'required|in:draft,published,archived',
            'published_at' => 'nullable|date',
        ], [
            'title.required' => 'Judul blog wajib diisi',
            'title.max' => 'Judul maksimal 255 karakter',
            'content.required' => 'Konten blog wajib diisi',
            'image.image' => 'File harus berupa gambar',
            'image.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau webp',
            'image.max' => 'Ukuran gambar maksimal 2MB',
            'author.max' => 'Nama penulis maksimal 100 karakter',
            'status.required' => 'Status wajib dipilih',
            'status.in' => 'Status tidak valid',
            'published_at.date' => 'Tanggal publish tidak valid',
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

            // Generate unique slug
            $data['slug'] = Str::slug($data['title']);
            $originalSlug = $data['slug'];
            $counter = 1;
            while (Blog::where('slug', $data['slug'])->exists()) {
                $data['slug'] = $originalSlug . '-' . $counter;
                $counter++;
            }

            // Handle image upload
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $data['image'] = $file->storeAs('blogs', $filename, 'public');
            }

            // Set published_at if status is published
            if ($data['status'] === 'published' && empty($data['published_at'])) {
                $data['published_at'] = now();
            }

            $blog = Blog::create($data);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Blog berhasil dibuat.',
                    'data' => $blog
                ], 201);
            }
            return redirect()->route('admin.blog.index')->with('success', 'Blog berhasil dibuat.');
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
        $blog = Blog::where('uuid', $uuid)->first();

        if (!$blog) {
            if (request()->ajax() || request()->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Blog tidak ditemukan.'
                ], 404);
            }
            return redirect()->back()->with('error', 'Blog tidak ditemukan.');
        }

        return view('backend.blog.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uuid)
    {
        $blog = Blog::where('uuid', $uuid)->first();

        if (!$blog) {
            return redirect()->back()->with('error', 'Blog tidak ditemukan.');
        }

        return view('backend.blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        $blog = Blog::where('uuid', $uuid)->first();

        if (!$blog) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Blog tidak ditemukan.'
                ], 404);
            }
            return redirect()->back()->with('error', 'Blog tidak ditemukan.');
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'author' => 'nullable|string|max:100',
            'status' => 'required|in:draft,published,archived',
            'published_at' => 'nullable|date',
        ], [
            'title.required' => 'Judul blog wajib diisi',
            'title.max' => 'Judul maksimal 255 karakter',
            'content.required' => 'Konten blog wajib diisi',
            'image.image' => 'File harus berupa gambar',
            'image.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau webp',
            'image.max' => 'Ukuran gambar maksimal 2MB',
            'author.max' => 'Nama penulis maksimal 100 karakter',
            'status.required' => 'Status wajib dipilih',
            'status.in' => 'Status tidak valid',
            'published_at.date' => 'Tanggal publish tidak valid',
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

            // Update slug if title changed
            if ($blog->title !== $data['title']) {
                $data['slug'] = Str::slug($data['title']);
                $originalSlug = $data['slug'];
                $counter = 1;
                while (Blog::where('slug', $data['slug'])->where('id', '!=', $blog->id)->exists()) {
                    $data['slug'] = $originalSlug . '-' . $counter;
                    $counter++;
                }
            }

            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($blog->image && Storage::disk('public')->exists($blog->image)) {
                    Storage::disk('public')->delete($blog->image);
                }

                $file = $request->file('image');
                $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $data['image'] = $file->storeAs('blogs', $filename, 'public');
            }

            // Set published_at if status is published
            if ($data['status'] === 'published' && empty($data['published_at'])) {
                $data['published_at'] = now();
            }

            $blog->update($data);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Blog berhasil diupdate.',
                    'data' => $blog->fresh()
                ]);
            }
            return redirect()->route('admin.blog.index')->with('success', 'Blog berhasil diupdate.');
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
        $blog = Blog::where('uuid', $uuid)->first();

        if (!$blog) {
            if (request()->ajax() || request()->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Blog tidak ditemukan.'
                ], 404);
            }
            return redirect()->back()->with('error', 'Blog tidak ditemukan.');
        }

        try {
            // Delete image file if exists
            if ($blog->image && Storage::disk('public')->exists($blog->image)) {
                Storage::disk('public')->delete($blog->image);
            }

            $blog->delete();

            if (request()->ajax() || request()->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Blog berhasil dihapus.'
                ]);
            }
            return redirect()->route('admin.blog.index')->with('success', 'Blog berhasil dihapus.');
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

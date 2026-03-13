<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\frontend\TentangKami;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminTentangController extends Controller
{
    /**
     * Display the single tentang kami record (view).
     */
    public function index()
    {
        $tentang = TentangKami::first();

        // Return view for display
        return view('backend.tentang.index', compact('tentang'));
    }

    /**
     * Store a newly created resource (single record only).
     */
    public function store(Request $request)
    {
        // Check if record already exists
        if (TentangKami::exists()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data Tentang Kami sudah ada. Gunakan method update untuk mengubah data.'
                ], 400);
            }
            return redirect()->back()->with('error', 'Data Tentang Kami sudah ada.');
        }

        $validator = Validator::make($request->all(), [
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'nullable|string',
           /*  'visi' => 'nullable|string',
            'misi' => 'nullable|array',
            'misi.*' => 'string|max:500', */
        ], [
            'logo.image' => 'File harus berupa gambar',
            'logo.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'logo.max' => 'Ukuran gambar maksimal 2MB',
            'deskripsi.string' => 'Deskripsi harus berupa teks',
           /*  'visi.string' => 'Visi harus berupa teks',
            'misi.array' => 'Misi harus berupa array',
            'misi.*.string' => 'Setiap misi harus berupa teks',
            'misi.*.max' => 'Setiap misi maksimal 500 karakter', */
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

            // Filter out empty misi values
            /* if (isset($data['misi']) && is_array($data['misi'])) {
                $data['misi'] = array_values(array_filter($data['misi'], function($value) {
                    return !empty(trim($value));
                }));
                if (empty($data['misi'])) {
                    $data['misi'] = null;
                }
            } */

            // Handle logo upload
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $data['logo'] = $file->storeAs('tentang-kami', $filename, 'public');
            }

            $tentang = TentangKami::create($data);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data Tentang Kami berhasil dibuat.',
                    'data' => $tentang
                ], 201);
            }
            return redirect()->route('admin.tentang.index')->with('success', 'Data Tentang Kami berhasil dibuat.');
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
    public function show($id)
    {
        $tentang = TentangKami::find($id);

        if (!$tentang) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $tentang
        ]);
    }

    /**
     * Update the single tentang kami record.
     */
    public function update(Request $request, $id)
    {
        $tentang = TentangKami::find($id);

        if (!$tentang) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data tidak ditemukan.'
                ], 404);
            }
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        $validator = Validator::make($request->all(), [
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'nullable|string',
            /* 'visi' => 'nullable|string',
            'misi' => 'nullable|array',
            'misi.*' => 'string|max:500', */
        ], [
            'logo.image' => 'File harus berupa gambar',
            'logo.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'logo.max' => 'Ukuran gambar maksimal 2MB',
            'deskripsi.string' => 'Deskripsi harus berupa teks',
           /*  'visi.string' => 'Visi harus berupa teks',
            'misi.array' => 'Misi harus berupa array',
            'misi.*.string' => 'Setiap misi harus berupa teks',
            'misi.*.max' => 'Setiap misi maksimal 500 karakter', */
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

            // Filter out empty misi values
            /* if (isset($data['misi']) && is_array($data['misi'])) {
                $data['misi'] = array_values(array_filter($data['misi'], function($value) {
                    return !empty(trim($value));
                }));
                if (empty($data['misi'])) {
                    $data['misi'] = null;
                }
            } */

            // Handle logo upload
            if ($request->hasFile('logo')) {
                // Delete old logo if exists
                if ($tentang->logo && Storage::disk('public')->exists($tentang->logo)) {
                    Storage::disk('public')->delete($tentang->logo);
                }

                $file = $request->file('logo');
                $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $data['logo'] = $file->storeAs('tentang-kami', $filename, 'public');
            }

            $tentang->update($data);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data Tentang Kami berhasil diupdate.',
                    'data' => $tentang->fresh()
                ]);
            }
            return redirect()->route('admin.tentang.index')->with('success', 'Data Tentang Kami berhasil diupdate.');
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
     * Remove the specified resource (soft delete).
     */
    public function destroy($id)
    {
        $tentang = TentangKami::find($id);

        if (!$tentang) {
            if (request()->ajax() || request()->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data tidak ditemukan.'
                ], 404);
            }
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        try {
            // Delete logo file if exists
            if ($tentang->logo && Storage::disk('public')->exists($tentang->logo)) {
                Storage::disk('public')->delete($tentang->logo);
            }

            $tentang->delete();

            if (request()->ajax() || request()->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data Tentang Kami berhasil dihapus.'
                ]);
            }
            return redirect()->route('admin.tentang.index')->with('success', 'Data Tentang Kami berhasil dihapus.');
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

    /**
     * Upload logo separately.
     */
    public function uploadLogo(Request $request, $id)
    {
        $tentang = TentangKami::find($id);

        if (!$tentang) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan.'
            ], 404);
        }

        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'logo.required' => 'File gambar harus diupload',
            'logo.image' => 'File harus berupa gambar',
            'logo.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'logo.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        try {
            // Delete old logo if exists
            if ($tentang->logo && Storage::disk('public')->exists($tentang->logo)) {
                Storage::disk('public')->delete($tentang->logo);
            }

            $file = $request->file('logo');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('tentang-kami', $filename, 'public');

            $tentang->update(['logo' => $path]);

            return response()->json([
                'status' => 'success',
                'message' => 'Logo berhasil diupload.',
                'logo_url' => asset('storage/' . $path),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengupload logo.',
            ], 500);
        }
    }
}

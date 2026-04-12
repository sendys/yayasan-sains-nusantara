<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\frontend\Divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DivisiController extends Controller
{
    /**
     * Display the single divisirecord (view).
     */
    public function index()
    {
        $divisi = Divisi::first();

        // Return view for display
        return view('backend.divisi.index', compact('divisi'));
    }

    /**
     * Store a newly created resource (single record only).
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'deskripsi_id' => 'nullable|string',
            'deskripsi_en' => 'nullable|string',
        ], [
            'deskripsi_id.string' => 'Deskripsi (ID) harus berupa teks',
            'deskripsi_en.string' => 'Deskripsi (EN) harus berupa teks',
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

            // Get existing record or create new one
            $divisi = Divisi::first() ?? new Divisi();
            $divisi->fill($data);
            $divisi->save();

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data berhasil disimpan.',
                    'data' => $divisi
                ], 201);
            }
            return redirect()->route('admin.divisi.index')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            \Log::error('divisi Store Error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage(),
                ], 500);
            }
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Update the single tentang kami record.
     */
    public function update(Request $request, $id)
    {
        $divisi = Divisi::find($id);

        if (!$divisi) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data tidak ditemukan.'
                ], 404);
            }
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        $validator = Validator::make($request->all(), [
            'deskripsi_id' => 'nullable|string',
            'deskripsi_en' => 'nullable|string',
        ], [
            'deskripsi_id.string' => 'Deskripsi (ID) harus berupa teks',
            'deskripsi_en.string' => 'Deskripsi (EN) harus berupa teks',
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
            $divisi->update($data);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data berhasil disimpan.',
                    'data' => $divisi->fresh()
                ]);
            }
            return redirect()->route('admin.divisi.index')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            \Log::error('divisi Update Error: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage(),
                ], 500);
            }
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $divisi = Divisi::find($id);

        if (!$divisi) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $divisi
        ]);
    }

    /**
     * Remove the specified resource (soft delete).
     */
    public function destroy($id)
    {
        $divisi = Divisi::find($id);

        if (!$divisi) {
            if (request()->ajax() || request()->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data tidak ditemukan.'
                ], 404);
            }
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        try {

            $divisi->delete();

            if (request()->ajax() || request()->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data divisi berhasil dihapus.'
                ]);
            }
            return redirect()->route('admin.divisi.index')->with('success', 'Data divisi berhasil dihapus.');
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

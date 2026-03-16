<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\frontend\Sejarah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SejarahController extends Controller
{
    /**
     * Display the single tentang kami record (view).
     */
    public function index()
    {
        $sejarah = Sejarah::first();

        // Return view for display
        return view('backend.sejarah.index', compact('sejarah'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Redirect to index view since this is a single-record model
        return redirect()->route('admin.sejarah.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sejarah = Sejarah::find($id);

        if (!$sejarah) {
            return redirect()->route('admin.sejarah.index')->with('error', 'Data tidak ditemukan.');
        }

        // Return view for editing
        return view('backend.sejarah.index', compact('sejarah'));
    }

    /**
     * Store a newly created resource (single record only).
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'deskripsi' => 'nullable|string',
        ], [
            'deskripsi.string' => 'Deskripsi harus berupa teks',
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
            $sejarah = Sejarah::first() ?? new Sejarah();
            $sejarah->fill($data);
            $sejarah->save();

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data berhasil disimpan.',
                    'data' => $sejarah
                ], 201);
            }
            return redirect()->route('admin.sejarah.index')->with('success', 'Data berhasil disimpan.');

        } catch (\Exception $e) {
            \Log::error('Sejarah Store Error: ' . $e->getMessage(), [
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
        $sejarah = Sejarah::find($id);

        if (!$sejarah) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $sejarah
        ]);
    }

    /**
     * Update the single tentang kami record.
     */
   public function update(Request $request, $id)
    {
        $sejarah = Sejarah::find($id);

        if (!$sejarah) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data tidak ditemukan.'
                ], 404);
            }
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        $validator = Validator::make($request->all(), [
            'deskripsi' => 'nullable|string',
        ], [
            'deskripsi.string' => 'Deskripsi harus berupa teks',
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
            $sejarah->update($data);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data berhasil disimpan.',
                    'data' => $sejarah->fresh()
                ]);
            }
            return redirect()->route('admin.sejarah.index')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            \Log::error('Sejarah Update Error: ' . $e->getMessage(), [
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
     * Remove the specified resource (soft delete).
     */
    public function destroy($id)
    {
        $sejarah = Sejarah::find($id);

        if (!$sejarah) {
            if (request()->ajax() || request()->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data tidak ditemukan.'
                ], 404);
            }
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        try {

            $sejarah->delete();

            if (request()->ajax() || request()->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Data berhasil dihapus.'
                ]);
            }
            return redirect()->route('admin.sejarah.index')->with('success', 'Data berhasil dihapus.');

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

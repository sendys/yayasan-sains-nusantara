<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PerusahaanController extends Controller
{
    public function index(Request $request)
    {
        $query = Perusahaan::query();

        if ($request->has('search')) {
            $searchTerm = '%'.$request->input('search').'%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', $searchTerm)
                    ->orWhere('email', 'like', $searchTerm)
                    ->orWhere('phone', 'like', $searchTerm)
                    ->orWhere('address', 'like', $searchTerm);
            });
        }

        $perusahaans = $query->orderBy('created_at', 'desc')->paginate(10);

        // Cek perusahaan dengan lisensi expired
        $expiredCompanies = Perusahaan::expired()->get();

        return view('perusahaan.index', compact('perusahaans', 'expiredCompanies'));
    }

    public function create()
    {
        return view('perusahaan.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:perusahaan,name',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_premium' => 'nullable|in:0,1',
            'is_status' => 'nullable|in:0,1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            Perusahaan::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'is_premium' => $request->is_premium ?? '0',
                'is_status' => $request->is_status ?? '1',
            ]);

            return redirect()->route('perusahaan.index')
                ->with('success', 'Perusahaan berhasil ditambahkan.');
        } catch (\Exception $e) {
            \Log::error('Failed to update perusahaan: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui perusahaan.')
                ->withInput();
        }
    }

    public function show(Perusahaan $perusahaan)
    {
        return view('perusahaan.show', compact('perusahaan'));
    }

    public function edit(Perusahaan $perusahaan)
    {
        return view('perusahaan.edit', compact('perusahaan'));
    }

    public function update(Request $request, $id)
    {
        $perusahaan = Perusahaan::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:perusahaan,name,'.$id,
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'is_premium' => 'nullable|in:0,1',
            'is_status' => 'nullable|in:0,1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $perusahaan->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'is_premium' => $request->is_premium ?? '0',
                'is_status' => $request->is_status ?? '1',
            ]);

            return redirect()->route('perusahaan.index')
                ->with('success', 'Perusahaan berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: '.$e->getMessage())
                ->withInput();
        }
    }

    public function destroy(Perusahaan $perusahaan)
    {
        try {
            $perusahaan->delete();
            return redirect()->route('perusahaan.index')
                ->with('success', 'Perusahaan berhasil dihapus.');
        } catch (\Exception $e) {
            \Log::error('Failed to delete perusahaan: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus perusahaan.');
        }
    }

    /**
     * Get expired companies for notification
     */
    public function getExpiredCompanies()
    {
        return Perusahaan::expired()->get();
    }

    /**
     * Check if there are expired companies
     */
    public function hasExpiredCompanies()
    {
        return Perusahaan::expired()->exists();
    }

    /**
     * Get companies expiring soon
     */
    public function getExpiringSoonCompanies($days = 7)
    {
        return Perusahaan::expiringSoon($days)->get();
    }
}

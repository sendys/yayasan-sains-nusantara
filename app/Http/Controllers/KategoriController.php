<?php

namespace App\Http\Controllers;

use App\Repositories\Kategori\KategoriRepositoriesInterface;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    protected $kategoriRepo;

    public function __construct(KategoriRepositoriesInterface $kategoriRepo)
    {
        $this->kategoriRepo = $kategoriRepo;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $params = [
            'search' => $search,
            'sort_by' => $request->input('sort_by', 'kode'),
            'sort_dir' => $request->input('sort_dir', 'asc'),
        ];
        $kategoris = $this->kategoriRepo->paginatedBySort($params, 10);

        return view('kategori.index', compact('kategoris', 'search'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'kode' => 'required|string|max:50|unique:kategori,kode',
            'nama' => 'required|string|max:100',
        ];

        $messages = [
            'kode.required' => 'Kode kategori harus diisi',
            'kode.string' => 'Kode kategori harus berupa teks',
            'kode.max' => 'Kode kategori maksimal 50 karakter',
            'kode.unique' => 'Kode kategori sudah digunakan',
            'nama.required' => 'Nama kategori harus diisi',
            'nama.string' => 'Nama kategori harus berupa teks',
            'nama.max' => 'Nama kategori maksimal 100 karakter',
        ];

        $validated = $request->validate($rules, $messages);

        $this->kategoriRepo->create($validated);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($uuid)
    {
        $kategori = $this->kategoriRepo->findByUuid($uuid);

        if (!$kategori) {
            return redirect()->route('kategori.index')->with('error', 'Kategori tidak ditemukan.');
        }

        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $uuid)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:50|unique:kategori,kode,'.$uuid.',uuid',
            'nama' => 'required|string|max:100',
        ]);
        $this->kategoriRepo->update($uuid, $validated);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diupdate.');
    }

    public function destroy($uuid)
    {
        $id = $this->kategoriRepo->findByUuid($uuid)->id;

        $this->kategoriRepo->softDelete($id);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}

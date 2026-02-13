<?php

namespace App\Http\Controllers;

use App\Repositories\Supplier\SupplierRepositoriesInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SupplierController extends Controller
{
    protected $supplierRepo;

    public function __construct(SupplierRepositoriesInterface $supplierRepo)
    {
        $this->supplierRepo = $supplierRepo;
    }

    public function index(Request $request)
    {
        $params = $request->all();
        $suppliers = $this->supplierRepo->paginatedBySort(
            array_merge($params, ['perusahaan_id' => Auth::user()->perusahaan_id]),
            $params['per_page'] ?? 10
        );

        return view('supplier.index', compact('suppliers'));
    }

    public function create()
    {
        return view('supplier.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string',
            'company_name' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time().'_'.$file->getClientOriginalName();
            $path = $file->storeAs('photos', $filename, 'public'); // disimpan di storage/app/public/photos
            $validated['photo'] = $path; // simpan path ke DB
        }

        $validated['perusahaan_id'] = Auth::user()->perusahaan_id;
        $this->supplierRepo->create($validated);

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil dibuat.');
    }

    public function edit($id)
    {
        $supplier = $this->supplierRepo->find($id);

        return view('supplier.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:supplier,email,$id",
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $supplier = $this->supplierRepo->find($id); // pastikan repo punya method `find($id)`

        // Cek jika ada file foto yang diunggah
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            // Hapus file lama jika ada
            if (! empty($supplier->photo) && \Illuminate\Support\Facades\Storage::disk('public')->exists($supplier->photo)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($supplier->photo);
            }

            // Simpan file baru
            $validated['photo'] = $request->file('photo')->store('photos', 'public');
        }

        $this->supplierRepo->update($id, $validated);

        return redirect()->route('supplier.index')->with('success', 'Supplier updated successfully.');
    }

    public function destroy($id)
    {
        $this->supplierRepo->delete($id);

        return redirect()->route('supplier.index')->with('success', 'Supplier deleted successfully.');
    }
}

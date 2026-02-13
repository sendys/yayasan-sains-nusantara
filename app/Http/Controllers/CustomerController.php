<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::query();
        if ($request->has('search')) {
            $searchTerm = '%'.$request->input('search').'%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', $searchTerm)
                    ->orWhere('email', 'like', $searchTerm)
                    ->orWhere('company_name', 'like', $searchTerm);
            });
        }

        // dd($query->get());
        $customers = $query->where('perusahaan_id', auth()->guard('web')->user()->perusahaan_id)->paginate(10);

        return view('customer.index', compact('customers'));
    }

    public function create()
    {
        return view('customer.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customer,email',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time().'_'.$file->getClientOriginalName();
            $path = $file->storeAs('photos', $filename, 'public'); // disimpan di storage/app/public/photos
            $validated['photo'] = $path; // simpan path ke DB
        }

        $validated['perusahaan_id'] = auth()->guard('web')->user()->perusahaan_id;

        Customer::create($validated);

        return redirect()->route('customer.index')->with('success', 'Customer created successfully.');
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);

        if ($customer->perusahaan_id !== auth()->guard('web')->user()->perusahaan_id) {
            abort(403, 'Unauthorized access');
        }

        return view('customer.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|unique:customer,name,'.$id,
            'email' => 'required|email',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',
        ]);

        $customer = Customer::findOrFail($id);

        // Cek jika ada file foto yang diunggah
        if ($request->hasFile('photo')) {
            // Hapus file lama jika ada
            if (! empty($customer->photo) && \Illuminate\Support\Facades\Storage::disk('public')->exists($customer->photo)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($customer->photo);
            }

            // Simpan file baru
            $validated['photo'] = $request->file('photo')->store('photos', 'public');
        }

        $customer->update(
            [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'company_name' => $request->company_name,
                'photo' => $validated['photo'] ?? $customer->photo,
            ]
        );

        return redirect()->route('customer.index')->with('success', 'Customer updated successfully.');
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->softDelete();

        return redirect()->route('customer.index')->with('success', 'Customer deleted successfully.');
    }
}

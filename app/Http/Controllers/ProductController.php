<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Product;
use App\Models\Satuan; // Tambahkan ini
use App\Repositories\Product\ProductRepository; // Tambahkan ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10); // Get per_page from request, default to 10
        $products = $this->productRepository->getAllProducts($perPage, $search); // Dynamic pagination

        return view('product.index', compact('products', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::all(); // Ambil semua kategori
        $satuans = Satuan::all(); // Ambil semua satuan

        return view('product.create', compact('kategoris', 'satuans')); // Sesuaikan path view jika perlu
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_code' => 'required|string|unique:product,product_code',
            'barcode' => 'required|string|unique:product,barcode',
            'product_name' => 'required|string|unique:product,product_name|max:255',
            'purchase_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'satuan_id' => 'required|exists:satuan,id',
            'kategori_id' => 'required|exists:kategori,id',
            'stock' => 'nullable|integer|min:0',
            'stock_min' => 'nullable|integer|min:0',
            'stock_max' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'product_code.required' => 'Kode produk wajib diisi',
            'product_code.unique' => 'Kode produk sudah ada',
            'product_name.required' => 'Nama produk wajib diisi',
            'product_name.unique' => 'Nama produk sudah ada',
            'purchase_price.required' => 'Harga beli wajib diisi',
            'purchase_price.numeric' => 'Harga beli harus berupa angka',
            'selling_price.required' => 'Harga jual wajib diisi',
            'selling_price.numeric' => 'Harga jual harus berupa angka',
            'barcode.unique' => 'Barcode sudah ada',
            'satuan_id.required' => 'Satuan wajib diisi',
            'satuan_id.exists' => 'Satuan yang dipilih tidak valid',
            'kategori_id.required' => 'Kategori wajib diisi',
            'kategori_id.exists' => 'Kategori yang dipilih tidak valid',
            'stock.integer' => 'Stok harus berupa angka',
            'stock.min' => 'Stok tidak boleh negatif',
            'image.image' => 'File harus berupa gambar',
            'image.mimes' => 'Gambar harus berformat jpeg, png, jpg, gif, atau svg',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 2MB',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->validated();

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/products'), $imageName);
            $data['image'] = 'images/products/'.$imageName;
        }

        // dd($data);
        $this->productRepository->createProduct($data);

        return redirect()->route('product.index')->with('success', 'Product created successfully.'); // Sesuaikan nama route jika perlu
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = $this->productRepository->getProductById($id);

        return view('product.show', compact('product')); // Sesuaikan path view jika perlu
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = $this->productRepository->getProductById($id);
        $kategoris = Kategori::all();
        $satuans = Satuan::all();

        return view('product.edit', compact('product', 'kategoris', 'satuans')); // Sesuaikan path view jika perlu
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = $this->productRepository->getProductById($id);
        $data = $request->validate([
            'product_code' => 'required|string|unique:product,product_code,'.$product->id,
            'barcode' => 'required|string|unique:product,barcode,'.$product->id,
            'product_name' => 'required|string|max:255',
            'purchase_price' => 'required|numeric|min:0',
            'satuan_id' => 'required|exists:satuan,id',
            'kategori_id' => 'required|exists:kategori,id',
            'selling_price' => 'required|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'stock_min' => 'nullable|integer|min:0',
            'stock_max' => 'nullable|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'product_code.required' => 'Kode produk wajib diisi',
            'product_code.unique' => 'Kode produk sudah ada',
            'product_name.required' => 'Nama produk wajib diisi',
            'product_name.unique' => 'Nama produk sudah ada',
            'purchase_price.required' => 'Harga beli wajib diisi',
            'purchase_price.numeric' => 'Harga beli harus berupa angka',
            'selling_price.required' => 'Harga jual wajib diisi',
            'selling_price.numeric' => 'Harga jual harus berupa angka',
            'barcode.unique' => 'Barcode sudah ada',
            'satuan_id.required' => 'Satuan wajib diisi',
            'satuan_id.exists' => 'Satuan yang dipilih tidak valid',
            'kategori_id.required' => 'Kategori wajib diisi',
            'kategori_id.exists' => 'Kategori yang dipilih tidak valid',
            'stock.integer' => 'Stok harus berupa angka',
            'stock.min' => 'Stok tidak boleh negatif',
            'stock_min.integer' => 'Stok minimum harus berupa angka',
            'stock_min.min' => 'Stok minimum tidak boleh negatif',
            'stock_max.integer' => 'Stok maksimum harus berupa angka',
            'stock_max.min' => 'Stok maksimum tidak boleh negatif',
            'image.image' => 'File harus berupa gambar',
            'image.mimes' => 'Gambar harus berformat jpeg, png, jpg, gif, atau svg',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 2MB',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada dan bukan gambar default
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/products'), $imageName);
            $data['image'] = 'images/products/'.$imageName;
        } elseif ($request->input('remove_image')) {
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }
            $data['image'] = null;
        }

        $this->productRepository->updateProduct($id, $data);

        return redirect()->route('product.index')->with('success', 'Product updated successfully.'); // Sesuaikan nama route jika perlu
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Get product details before deletion
        $product = $this->productRepository->getProductById($id);

        // Delete product image if exists
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        // Delete the product record
        $this->productRepository->deleteProduct($id);

        return redirect()->route('product.index')->with('success', 'Product deleted successfully.'); // Sesuaikan nama route jika perlu
    }

    /**
     * Generate unique 13-digit barcode
     */
    public function generateBarcode()
    {
        do {
            // Generate random 13-digit number
            $barcode = str_pad(mt_rand(1, 9999999999999), 13, '0', STR_PAD_LEFT);

            // Check if barcode already exists in database
            $exists = Product::where('barcode', $barcode)->exists();
        } while ($exists);

        return response()->json([
            'success' => true,
            'barcode' => $barcode,
        ]);
    }

    public function select2Product(Request $request)
    {
        $term = $request->get('q');

        $products = \App\Models\Product::with(['kategori', 'satuan'])
            ->where('product_name', 'LIKE', '%'.$term.'%')
            ->take(10)
            ->get()
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'text' => $product->product_name,
                    'purchase_price' => $product->purchase_price,
                    'satuan_id' => $product->satuan_id,
                    'satuan_nama' => $product->satuan->nama ?? '',
                ];
            });

        return response()->json([
            'items' => $products,
            'pagination' => ['more' => false],
        ]);
    }
}

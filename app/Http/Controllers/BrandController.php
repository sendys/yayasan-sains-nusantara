<?php

namespace App\Http\Controllers;

use App\Repositories\Brand\BrandRepositoriesInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use League\Csv\Reader;

class BrandController extends Controller
{
    protected $brandRepo;

    public function __construct(BrandRepositoriesInterface $brandRepo)
    {
        $this->brandRepo = $brandRepo;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $params = [
            'search' => $search,
            'is_active' => $request->input('is_active'),
            'sort_by' => $request->input('sort_by', 'nama'),
            'sort_dir' => $request->input('sort_dir', 'asc'),
        ];

        $perPage = $request->input('per_page', 10);
        $brands = $this->brandRepo->paginatedBySort($params, $perPage);

        return view('brand.index', compact('brands', 'search'));
    }

    public function store(Request $request)
    {
        $rules = [
            'nama' => 'required|string|max:100|unique:brand,nama',
            'deskripsi' => 'nullable|string|max:500',
            // Hapus validasi boolean untuk is_active karena checkbox bisa tidak ada
        ];

        $messages = [
            'nama.required' => 'Nama brand harus diisi',
            'nama.string' => 'Nama brand harus berupa teks',
            'nama.max' => 'Nama brand maksimal 100 karakter',
            'nama.unique' => 'Nama brand sudah digunakan',
            'deskripsi.string' => 'Deskripsi harus berupa teks',
            'deskripsi.max' => 'Deskripsi maksimal 500 karakter',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => 'Validasi gagal',
                        'errors' => $validator->errors(),
                    ],
                    422,
                );
            }

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();
        // Handle checkbox: jika ada dan bernilai 'on' atau '1', maka true, selainnya false
        $validated['is_active'] =
            $request->has('is_active') &&
            in_array($request->input('is_active'), ['on', '1', 'true', true]);

        try {
            $this->brandRepo->create($validated);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'message' => 'Brand berhasil ditambahkan.',
                    'status' => 'success',
                ]);
            }

            return redirect()
                ->back()
                ->with('success', 'Brand berhasil ditambahkan.');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error(
                'Error in BrandController@store: '.$e->getMessage(),
            );

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => 'Terjadi kesalahan saat menyimpan data.',
                    ],
                    500,
                );
            }

            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }

    public function show($uuid)
    {
        // show brand
        $brand = $this->brandRepo->findByUuid($uuid);

        return response()->json($brand);
    }

    public function update(Request $request, $uuid)
    {
        // Force JSON response untuk semua request ke method ini
        $request->headers->set('Accept', 'application/json');

        $brand = $this->brandRepo->findByUuid($uuid);

        if (! $brand) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Brand tidak ditemukan.',
                ],
                404,
            );
        }

        $rules = [
            'nama' => 'required|string|max:100|unique:brand,nama,'.$uuid.',uuid',
            'deskripsi' => 'nullable|string|max:500',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors(),
                ],
                422,
            );
        }

        $validated = $validator->validated();
        // Handle checkbox dengan lebih robust
        $validated['is_active'] =
            $request->has('is_active') &&
            in_array($request->input('is_active'), ['on', '1', 'true', true]);

        try {
            $this->brandRepo->update($uuid, $validated);

            return response()->json([
                'message' => 'Brand berhasil diupdate.',
                'status' => 'success',
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error(
                'Error in BrandController@update: '.$e->getMessage(),
            );

            /* return response()->json( */
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan saat mengupdate data.',
                ],
                500,
            );
        }
    }

    public function destroy($uuid)
    {
        $brand = $this->brandRepo->findByUuid($uuid);

        if (! $brand) {
            return redirect()
                ->route('brand.index')
                ->with('error', 'Brand tidak ditemukan.');
        }

        $this->brandRepo->softDelete($brand->id);

        return redirect()
            ->route('brand.index')
            ->with('success', 'Brand berhasil dihapus.');
    }

    public function uploadImage(Request $request, $uuid)
    {
        $brand = $this->brandRepo->findByUuid($uuid);

        if (! $brand) {
            return response()->json(['error' => 'Brand tidak ditemukan'], 404);
        }

        // validasi request
        $request->validate(
            [
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ],
            [
                'logo.required' => 'File gambar harus diupload',
                'logo.image' => 'File harus berupa gambar',
                'logo.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
                'logo.max' => 'Ukuran gambar maksimal 2MB',
            ],
        );

        try {
            // Hapus logo lama jika ada
            if ($brand->logo && Storage::disk('public')->exists($brand->logo)) {
                Storage::disk('public')->delete($brand->logo);
            }

            // Upload logo baru
            $file = $request->file('logo');
            $filename = Str::uuid().'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('brands', $filename, 'public');

            // Update brand dengan logo baru
            $this->brandRepo->update($uuid, ['logo' => $path]);

            return response()->json([
                'message' => 'Logo brand berhasil diupload.',
                'logo_url' => asset('storage/'.$path),
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error in BrandController@uploadImage: '.$e->getMessage());

            return response()->json(
                ['error' => 'Gagal mengupload logo.'],
                500,
            );
        }
    }

    public function bulkImport()
    {
        return view('brand.bulk-import');
    }

    public function processBulkImport(Request $request)
    {
        $request->validate(
            [
                'csv_file' => 'required|file|mimes:csv,txt|max:2048',
            ],
            [
                'csv_file.required' => 'File CSV wajib diupload',
                'csv_file.file' => 'File yang diupload harus berupa file',
                'csv_file.mimes' => 'File harus berformat CSV',
                'csv_file.max' => 'Ukuran file maksimal 2MB',
            ],
        );

        try {
            $file = $request->file('csv_file');
            $csv = Reader::createFromPath($file->getPathname(), 'r');
            $csv->setHeaderOffset(0);

            $records = $csv->getRecords();
            $successCount = 0;
            $errorCount = 0;
            $errors = [];
            $rowNumber = 1;

            DB::beginTransaction();

            foreach ($records as $record) {
                $rowNumber++;

                // Validasi data per baris
                $validator = Validator::make($record, [
                    'nama' => 'required|string|max:100|unique:brand,nama',
                    'deskripsi' => 'nullable|string|max:500',
                    'is_active' => 'nullable',
                ]);

                if ($validator->fails()) {
                    $errorCount++;
                    $errors[] =
                        "Baris {$rowNumber}: ".
                        implode(', ', $validator->errors()->all());

                    continue;
                }

                try {
                    // Normalisasi nilai is_active dari CSV
                    $isActive = true;
                    if (isset($record['is_active'])) {
                        $val = strtolower(trim((string) $record['is_active']));
                        $isActive = in_array($val, ['1', 'true', 'yes', 'on'], true);
                    }

                    $this->brandRepo->create([
                        'nama' => $record['nama'],
                        'deskripsi' => $record['deskripsi'] ?? null,
                        'is_active' => $isActive,
                    ]);

                    $successCount++;
                } catch (\Exception $e) {
                    $errorCount++;
                    $errors[] =
                        "Baris {$rowNumber}: Gagal menyimpan data - ".
                        $e->getMessage();
                }
            }

            if ($errorCount > 0) {
                DB::rollBack();
            } else {
                DB::commit();
            }

            $message = "Import selesai. {$successCount} data berhasil diimport";
            if ($errorCount > 0) {
                $message .= ", {$errorCount} data gagal";
            }

            if (! empty($errors)) {
                return redirect()
                    ->back()
                    ->with('warning', $message)
                    ->with('errors', $errors);
            }

            return redirect()->route('brand.index')->with('success', $message);
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Gagal memproses file CSV: '.$e->getMessage(),
                );
        }
    }

    public function downloadTemplate()
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="template_brand.csv"',
        ];

        $callback = function () {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['kode', 'nama', 'deskripsi', 'is_active']); // Header CSV sesuai struktur tabel
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}

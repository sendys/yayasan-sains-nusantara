<?php

namespace App\Http\Controllers;

use App\Repositories\Satuan\SatuanRepositoriesInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use League\Csv\Reader;

class SatuanController extends Controller
{
    protected $satuanRepo;

    public function __construct(SatuanRepositoriesInterface $satuanRepo)
    {
        $this->satuanRepo = $satuanRepo;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $params = [
            'search' => $search,
            'sort_by' => $request->input('sort_by', 'kode'),
            'sort_dir' => $request->input('sort_dir', 'asc'),
        ];

        $perPage = $request->input('per_page', 10); // Get per_page from request, default to 10
        $satuans = $this->satuanRepo->paginatedBySort($params, $perPage);

        return view('satuan.index', compact('satuans', 'search'));
    }

    public function create()
    {
        return view('satuan.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'kode' => 'required|string|max:50|unique:satuan,kode',
            'nama' => 'required|string|max:100',
        ];

        $messages = [
            'kode.required' => 'Kode satuan harus diisi',
            'kode.string' => 'Kode satuan harus berupa teks',
            'kode.max' => 'Kode satuan maksimal 50 karakter',
            'kode.unique' => 'Kode satuan sudah digunakan',
            'nama.required' => 'Nama satuan harus diisi',
            'nama.string' => 'Nama satuan harus berupa teks',
            'nama.max' => 'Nama satuan maksimal 100 karakter',
        ];

        $validated = $request->validate($rules, $messages);

        $this->satuanRepo->create($validated);

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Satuan berhasil ditambahkan.',
                'status' => 'success',
            ]);
        }

        return redirect()->back()->with('success', 'Satuan berhasil ditambahkan.');
    }

    public function edit($uuid)
    {
        $satuan = $this->satuanRepo->findByUuid($uuid);

        if (! $satuan) {
            return redirect()->route('satuan.index')->with('error', 'Satuan tidak ditemukan.');
        }

        /* return view('satuan.edit', compact('satuan')); */
        return response()->json($satuan);
    }

    public function update(Request $request, $uuid)
    {
        $satuan = $this->satuanRepo->findByUuid($uuid);

        if (! $satuan) {
            return redirect()->route('satuan.index')->with('error', 'Satuan tidak ditemukan.');
        }

        $validated = $request->validate([
            'kode' => 'required|string|max:50|unique:satuan,kode,'.$uuid.',uuid',
            'nama' => 'required|string|max:100',
        ]);

        $this->satuanRepo->update($uuid, $validated);

        /*  return response()->json(['message' => 'Satuan updated successfully']); */
        return redirect()->route('satuan.index')->with('success', 'Satuan berhasil diupdate.');
    }

    public function destroy($uuid)
    {
        $satuan = $this->satuanRepo->findByUuid($uuid);

        if (! $satuan) {
            return redirect()->route('satuan.index')->with('error', 'Satuan tidak ditemukan.');
        }

        $this->satuanRepo->softDelete($satuan->id);

        return redirect()->route('satuan.index')->with('success', 'Satuan berhasil dihapus (soft delete).');
    }

    public function trashed()
    {
        $trashedSatuans = $this->satuanRepo->getTrashed(10);

        return view('satuan.trashed', compact('trashedSatuans'));
    }

    public function restore($id)
    {
        try {
            $this->satuanRepo->restore($id);

            return redirect()->route('satuan.trashed')->with('success', 'Satuan berhasil dipulihkan.');
        } catch (\Exception $e) {
            return redirect()->route('satuan.trashed')->with('error', 'Satuan tidak ditemukan atau gagal dipulihkan.');
        }
    }

    public function forceDelete($id)
    {
        try {
            $this->satuanRepo->forceDelete($id);

            return redirect()->route('satuan.trashed')->with('success', 'Satuan berhasil dihapus permanen.');
        } catch (\Exception $e) {
            return redirect()->route('satuan.trashed')->with('error', 'Satuan tidak ditemukan atau gagal dihapus.');
        }
    }

    public function bulkImport()
    {
        return view('satuan.bulk-import');
    }

    public function processBulkImport(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
        ], [
            'csv_file.required' => 'File CSV wajib diupload',
            'csv_file.file' => 'File yang diupload harus berupa file',
            'csv_file.mimes' => 'File harus berformat CSV',
            'csv_file.max' => 'Ukuran file maksimal 2MB',
        ]);

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
                    'kode' => 'required|string|max:50|unique:satuan,kode',
                    'nama' => 'required|string|max:100',
                ]);

                if ($validator->fails()) {
                    $errorCount++;
                    $errors[] = "Baris {$rowNumber}: ".implode(', ', $validator->errors()->all());

                    continue;
                }

                try {
                    $this->satuanRepo->create([
                        'kode' => $record['kode'],
                        'nama' => $record['nama'],
                    ]);
                    $successCount++;
                } catch (\Exception $e) {
                    $errorCount++;
                    $errors[] = "Baris {$rowNumber}: Gagal menyimpan data - ".$e->getMessage();
                }
            }

            DB::commit();

            $message = "Import selesai. {$successCount} data berhasil diimport";
            if ($errorCount > 0) {
                $message .= ", {$errorCount} data gagal";
            }

            if (! empty($errors)) {
                return redirect()->back()->with('warning', $message)->with('errors', $errors);
            }

            return redirect()->route('satuan.index')->with('success', $message);
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', 'Gagal memproses file CSV: '.$e->getMessage());
        }
    }

    public function downloadTemplate()
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="template_satuan.csv"',
        ];

        $callback = function () {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['kode', 'nama']); // Header CSV
            fputcsv($file, ['SAT001', 'Kilogram']); // Contoh data
            fputcsv($file, ['SAT002', 'Meter']); // Contoh data
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}

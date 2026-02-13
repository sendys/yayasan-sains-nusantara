<?php

namespace App\Http\Controllers;

use App\Repositories\Gudang\GudangRepositoriesInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use League\Csv\Reader;

class GudangController extends Controller
{
    protected $gudangRepo;

    public function __construct(GudangRepositoriesInterface $gudangRepo)
    {
        $this->gudangRepo = $gudangRepo;
    }

    public function index(Request $request)
    {
        $params = $request->all();
        $sort = $params['sort'] ?? 'asc';
        $gudangs = $this->gudangRepo->paginatedBySort($params, $params['per_page'] ?? 10, $sort);

        return view('gudang.index', compact('gudangs'));
    }

    public function create()
    {
        return view('gudang.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:50|unique:gudang,kode',
            'nama' => 'required|string|max:255',
        ], [
            'kode.required' => 'Warehouse code is required',
            'kode.string' => 'Warehouse code must be text',
            'kode.max' => 'Warehouse code cannot exceed 50 characters',
            'kode.unique' => 'Warehouse code already exists',
            'nama.required' => 'Warehouse name is required',
            'nama.string' => 'Warehouse name must be text',
            'nama.max' => 'Warehouse name cannot exceed 255 characters',
        ]);
        $this->gudangRepo->create($validated);

        return redirect()->back()->with('success', 'Gudang berhasil dibuat.');
    }

    public function edit($uuid)
    {
        $gudang = $this->gudangRepo->findByUuid($uuid);

        return view('gudang.edit', compact('gudang'));
    }

    public function update(Request $request, $uuid)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:50|unique:gudang,kode,'.$uuid.',uuid',
            'nama' => 'required|string|max:255',
        ]);
        $this->gudangRepo->update($uuid, $validated);

        return redirect()->route('gudang.index')->with('success', 'Gudang berhasil diupdate.');
    }

    public function destroy($uuid)
    {
        $gudang = $this->gudangRepo->findByUuid($uuid);
        if ($gudang) {
            $this->gudangRepo->delete($gudang->id);
        }

        return redirect()->route('gudang.index')->with('success', 'Gudang berhasil dihapus.');
    }

    public function bulkImport()
    {
        return view('gudang.bulk-import');
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
                    'kode' => 'required|string|max:50|unique:gudang,kode',
                    'nama' => 'required|string|max:255',
                ]);

                if ($validator->fails()) {
                    $errorCount++;
                    $errors[] = "Baris {$rowNumber}: ".implode(', ', $validator->errors()->all());

                    continue;
                }

                try {
                    $this->gudangRepo->create([
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

            return redirect()->route('gudang.index')->with('success', $message);
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', 'Gagal memproses file CSV: '.$e->getMessage());
        }
    }

    public function downloadTemplate()
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="template_gudang.csv"',
        ];

        $callback = function () {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['kode', 'nama']);
            fputcsv($file, ['GD001', 'Gudang Utama']);
            fputcsv($file, ['GD002', 'Gudang Cabang']);
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}

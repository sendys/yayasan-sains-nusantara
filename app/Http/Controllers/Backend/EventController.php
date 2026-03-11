<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::orderBy('created_at', 'desc')->paginate(10);
        return view('backend.event.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.event.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'event_date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'category' => 'nullable|string|max:100',
            'registration_link' => 'nullable|string|max:255',
            'max_participants' => 'nullable|integer|min:1',
            'status' => 'required|in:draft,published,cancelled,completed',
            'published_at' => 'nullable|date',
        ], [
            'title.required' => 'Judul acara wajib diisi',
            'title.max' => 'Judul maksimal 255 karakter',
            'event_date.required' => 'Tanggal acara wajib diisi',
            'event_date.date' => 'Format tanggal tidak valid',
            'location.max' => 'Lokasi maksimal 255 karakter',
            'image.image' => 'File harus berupa gambar',
            'image.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau webp',
            'image.max' => 'Ukuran gambar maksimal 2MB',
            'category.max' => 'Kategori maksimal 100 karakter',
            'registration_link.max' => 'Link pendaftaran maksimal 255 karakter',
            'max_participants.integer' => 'Jumlah peserta harus angka',
            'max_participants.min' => 'Jumlah peserta minimal 1',
            'status.required' => 'Status wajib dipilih',
            'status.in' => 'Status tidak valid',
            'published_at.date' => 'Tanggal publish tidak valid',
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

            // Generate unique slug
            $data['slug'] = Str::slug($data['title']);
            $originalSlug = $data['slug'];
            $counter = 1;
            while (Event::where('slug', $data['slug'])->exists()) {
                $data['slug'] = $originalSlug . '-' . $counter;
                $counter++;
            }

            // Handle image upload
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $data['image'] = $file->storeAs('events', $filename, 'public');
            }

            // Set published_at if status is published
            if ($data['status'] === 'published' && empty($data['published_at'])) {
                $data['published_at'] = now();
            }

            $event = Event::create($data);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Acara berhasil dibuat.',
                    'data' => $event
                ], 201);
            }
            return redirect()->route('admin.event.index')->with('success', 'Acara berhasil dibuat.');
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan saat menyimpan data.',
                ], 500);
            }
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data.')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($uuid)
    {
        $event = Event::where('uuid', $uuid)->first();

        if (!$event) {
            if (request()->ajax() || request()->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Acara tidak ditemukan.'
                ], 404);
            }
            return redirect()->back()->with('error', 'Acara tidak ditemukan.');
        }

        return view('backend.event.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uuid)
    {
        $event = Event::where('uuid', $uuid)->first();

        if (!$event) {
            return redirect()->back()->with('error', 'Acara tidak ditemukan.');
        }

        return view('backend.event.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $uuid)
    {
        $event = Event::where('uuid', $uuid)->first();

        if (!$event) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Acara tidak ditemukan.'
                ], 404);
            }
            return redirect()->back()->with('error', 'Acara tidak ditemukan.');
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'event_date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'category' => 'nullable|string|max:100',
            'registration_link' => 'nullable|string|max:255',
            'max_participants' => 'nullable|integer|min:1',
            'status' => 'required|in:draft,published,cancelled,completed',
            'published_at' => 'nullable|date',
        ], [
            'title.required' => 'Judul acara wajib diisi',
            'title.max' => 'Judul maksimal 255 karakter',
            'event_date.required' => 'Tanggal acara wajib diisi',
            'event_date.date' => 'Format tanggal tidak valid',
            'location.max' => 'Lokasi maksimal 255 karakter',
            'image.image' => 'File harus berupa gambar',
            'image.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau webp',
            'image.max' => 'Ukuran gambar maksimal 2MB',
            'category.max' => 'Kategori maksimal 100 karakter',
            'registration_link.max' => 'Link pendaftaran maksimal 255 karakter',
            'max_participants.integer' => 'Jumlah peserta harus angka',
            'max_participants.min' => 'Jumlah peserta minimal 1',
            'status.required' => 'Status wajib dipilih',
            'status.in' => 'Status tidak valid',
            'published_at.date' => 'Tanggal publish tidak valid',
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

            // Update slug if title changed
            if ($event->title !== $data['title']) {
                $data['slug'] = Str::slug($data['title']);
                $originalSlug = $data['slug'];
                $counter = 1;
                while (Event::where('slug', $data['slug'])->where('id', '!=', $event->id)->exists()) {
                    $data['slug'] = $originalSlug . '-' . $counter;
                    $counter++;
                }
            }

            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($event->image && Storage::disk('public')->exists($event->image)) {
                    Storage::disk('public')->delete($event->image);
                }

                $file = $request->file('image');
                $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $data['image'] = $file->storeAs('events', $filename, 'public');
            }

            // Set published_at if status is published
            if ($data['status'] === 'published' && empty($data['published_at'])) {
                $data['published_at'] = now();
            }

            $event->update($data);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Acara berhasil diupdate.',
                    'data' => $event->fresh()
                ]);
            }
            return redirect()->route('admin.event.index')->with('success', 'Acara berhasil diupdate.');
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan saat mengupdate data.',
                ], 500);
            }
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengupdate data.')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        $event = Event::where('uuid', $uuid)->first();

        if (!$event) {
            if (request()->ajax() || request()->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Acara tidak ditemukan.'
                ], 404);
            }
            return redirect()->back()->with('error', 'Acara tidak ditemukan.');
        }

        try {
            // Delete image file if exists
            if ($event->image && Storage::disk('public')->exists($event->image)) {
                Storage::disk('public')->delete($event->image);
            }

            $event->delete();

            if (request()->ajax() || request()->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Acara berhasil dihapus.'
                ]);
            }
            return redirect()->route('admin.event.index')->with('success', 'Acara berhasil dihapus.');
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

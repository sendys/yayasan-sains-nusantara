<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of published galleries.
     */
    public function index(Request $request)
    {
        $galleries = Gallery::active()
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        if ($request->ajax()) {
            return view('frontend.galeri.partials.gallery-items', compact('galleries'))->render();
        }

        return view('frontend.galeri.index', compact('galleries'));
    }

    /**
     * Display galleries filtered by kategori.
     */
    public function byKategori(Request $request, $kategori)
    {
        $galleries = Gallery::active()
            ->byKategori($kategori)
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        $kategoriList = Gallery::getKategoriList();
        $kategoriLabel = $kategoriList[$kategori] ?? $kategori;

        if ($request->ajax()) {
            return view('frontend.galeri.partials.gallery-items', compact('galleries'))->render();
        }

        return view('frontend.galeri.index', compact('galleries', 'kategori', 'kategoriLabel'));
    }

    /**
     * Display the specified gallery.
     */
    public function show($uuid)
    {
        $gallery = Gallery::where('uuid', $uuid)->active()->firstOrFail();

        $relatedGalleries = Gallery::active()
            ->where('id', '!=', $gallery->id)
            ->where('kategori', $gallery->kategori)
            ->latest()
            ->limit(4)
            ->get();

        return view('frontend.galeri.show', compact('gallery', 'relatedGalleries'));
    }
}
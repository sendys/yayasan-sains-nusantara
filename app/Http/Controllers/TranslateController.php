<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslateController extends Controller
{
    public function translate(Request $request)
    {
        try {

            // validasi
            $request->validate([
                'text' => 'required|string'
            ]);

            $text = $request->text;

            // batasi panjang (biar aman dari limit)
            $text = substr($text, 0, 5000);

            // init translator
            $tr = new GoogleTranslate('en');
            $tr->setSource('id');

            // translate
            $translated = $tr->translate($text);

            return response()->json([
                'status' => 'success',
                'result' => $translated
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status' => 'error',
                'message' => 'Gagal translate',
                'error' => $e->getMessage() // optional debug
            ], 500);
        }
    }
}

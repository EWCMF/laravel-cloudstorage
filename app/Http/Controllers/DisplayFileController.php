<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class DisplayFileController extends Controller
{
    public function image($id) {
        $name = File::find($id)->name;

        return view('image-view', [
            'name' => $name,
            'id' => $id,
        ]);
    }

    public function video($id) {
        $file = File::find($id);
        $name = $file->name;
        $path = $file->full_path;
        $type = Storage::mimeType($path);

        return view('video-view', [
            'name' => $name,
            'id' => $id,
            'type' => $type,
        ]);
    }

    public function audio($id) {
        $file = File::find($id);
        $name = $file->name;
        $path = $file->full_path;
        $type = Storage::mimeType($path);

        return view('audio-view', [
            'name' => $name,
            'id' => $id,
            'type' => $type,
        ]);
    }

    public function load($id) {
        $path = File::find($id)->full_path;

        if (!Storage::exists($path)) {
            abort(404);
        }

        $fullPath = Storage::path($path);
        $size = Storage::size($path);
        $type = Storage::mimeType($path);

        $header = [
            'Content-type' => $type,
            'Content-Length ' => $size,
        ];

        return response()->file($fullPath, $header);
    }

    public function download($id) {
        $file = File::find($id);
        $name = $file->name;
        $path = $file->full_path;

        if (!Storage::exists($path)) {
            abort(404);
        }

        $type = Storage::mimeType($path);
        $size = Storage::size($path);

        $header = [
            'Content-type' => $type,
            'Content-Length ' => $size,
        ];

        return Storage::download($path, $name, $header);
    }
}

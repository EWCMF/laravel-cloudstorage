<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{

    public function index($path = null) {
        $id = auth()->user()->id;
        $dir = isset($path) ? $path : null;
        $files = File::where('user_id', $id)->where('relative_dir_path', $dir)->get();

        foreach ($files as $file) {
            $size = $file->size;
            if (!isset($size)) {
                continue;
            }

            $size = $size / 1000 / 1000;

            if ($size < 1) {
                $size = $size * 1000;
                $size = $size . " KB";
            } else {
                $size = $size . " MB";
            }

            $file->size = $size;
        }

        $parent = isset($path) && str_contains($path, '/') ? substr($path, 0, strrpos($path, '/')) : null;

        return view('home', [
            'files' => $files,
            'path' => $path,
            'parent' => $parent,
        ]);
    }

    public function fileUpload(Request $request) {
        $userFolder = auth()->user()->id;
        $folder = $request->folder;
        $fullFolder = isset($folder) ? "users/" . $userFolder . '/' . $folder : "users/" . $userFolder;
        $file = $request->file('upload');
        $ext = $file->extension();
        $path = $file->store($fullFolder);
        $size = $file->getSize();
        $relativePath = preg_replace('/[^\/]+\/[^\/]+\//', '', $path, 1);

        if (!$path) {
            abort(404);
        }

        if (!isset($ext)) {
            $ext = 'File';
        }

        $request->user()->files()->create([
            'relative_dir_path' => $folder,
            'relative_path' => $relativePath,
            'full_path' => $path,
            'name' => $file->getClientOriginalName(),
            'type' => $ext,
            'size' => $size,
        ]);

        return back();
    }

    public function newDirectory(Request $request) {
        if (!isset($request->name)) {
            abort(404);
        }

        $userFolder = auth()->user()->id;
        $folder = $request->folder;
        $name = $request->name;
        $fullpath = isset($folder) ? 'users/' . $userFolder . '/' . $folder . '/' . $name : 'users/' . $userFolder . '/' . $name;
        $relativePath =  preg_replace('/[^\/]+\/[^\/]+\//', '', $fullpath, 1);

        $created = Storage::makeDirectory($fullpath);

        if (!$created) {
            abort(404);
        }

        $request->user()->files()->create([
            'relative_dir_path' => $folder,
            'relative_path' => $relativePath,
            'full_path' => $fullpath,
            'name' => $name,
            'type' => 'DIR',
        ]);

        return back();
    }

    public function fileDelete($id) {
        $file = File::find($id);

        if ($file->type == 'DIR') {
            Storage::deleteDirectory($file->full_path);
            DB::table('files')->where('relative_dir_path', 'like', $file->relative_path . '%')->delete();
            File::destroy($id);
        } else {
            Storage::delete($file->full_path);
            File::destroy($id);
        }

        return back();
    }
}

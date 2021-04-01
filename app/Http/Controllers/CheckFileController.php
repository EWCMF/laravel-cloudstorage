<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class CheckFileController extends Controller
{
    public function check($id) {
        $file = File::find($id);
        $type = $file->type;

        if ($type == 'DIR') {
            return redirect()->route('home', $file->relative_path);
        }

        $imageTypes = array('png', 'jpg');

        if (in_array($type, $imageTypes)) {
            return redirect()->route('display.image', $id);
        }

        $videoTypes = array('mp4', 'webm');

        if (in_array($type, $videoTypes)) {
            return redirect()->route('display.video', $id);
        }

        $audioTypes = array('mp3', 'ogg', 'wav');

        if (in_array($type, $audioTypes)) {
            return redirect()->route('display.audio', $id);
        }

        return redirect()->route('display.download', $id);
    }
}

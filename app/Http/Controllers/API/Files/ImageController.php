<?php

namespace App\Http\Controllers\Api\Files;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;

class ImageController extends Controller
{
    public function store(Request $request, $type)
    {
        $this->validate($request, [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $image = $request->file('file');
        $input['imagename'] = time() . '_' . str_random(10) . '.' . $image->extension();
        $destinationPath = storage_path('app/public/' . $type . '/');
        $image->move($destinationPath, $input['imagename']);

        return response()->json(['success' => '1', 'message' => 'Image Upload successful', 'image_url' => '/storage/' . $type . '/' . $input['imagename']]);
    }
}

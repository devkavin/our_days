<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Photo;
use App\Helpers\FileHelper;

class PhotoController extends Controller
{
    public function index()
    {
        return view('pages.profile.photos');
    }

    public function loadPhotos()
    {

        $user_id = auth()->user()->id;
        $photos = Photo::getAllPhotos($user_id);
        return response()->json([
            'photos' => $photos
        ]);
    }

    public function show($id)
    {
        $photo = Photo::find($id);
        dd($photo, 'show');
        return redirect($photo->url);
    }

    public function store(Request $request)
    {
        $profile = auth()->user();

        try {
            $validatedData = $request->validate([
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'photo_type' => 'required|integer', // 1 = profile photo, 2 = cover photo
                'is_public' => 'sometimes|boolean',
            ]);

            $photoType = (int) $validatedData['photo_type'];
            $photoTypeName = (strtolower(str_replace(' ', '_', Photo::PHOTO_TYPES[$photoType])) . 's');

            $isPublic = $validatedData['is_public'] ?? false;

            $file = $validatedData['photo'];
            $file_details = FileHelper::saveImageWithURL($file, 'images/' . $photoTypeName);
            $savedPath = $file_details['saved_path'];
            $savedName = $file_details['saved_name'];
            $extension = $file_details['extension'];

            $photo = new Photo();
            $photo->user_id = $profile->id;
            $photo->type_id = $photoType;
            $photo->is_public = $isPublic;
            $photo->name = $savedName;
            $photo->extension = $extension;
            $photo->url = $savedPath;
            $photo->save();

            // $photo->save();

            return redirect()->back()->with([
                'message' => 'Photo uploaded successfully',
                'alert-type' => 'success'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $photo = Photo::find($id);
        dd($photo, 'update');
        $photo->is_public = $request->is_public;
        $photo->save();

        return redirect()->back()->with([
            'message' => 'Photo updated successfully',
            'alert-type' => 'success'
        ]);
    }

    public function destroy($id)
    {
        $photo = Photo::find($id);
        dd($photo, 'destroy');
        $photo->delete();

        return redirect()->back()->with([
            'message' => 'Photo deleted successfully',
            'alert-type' => 'success'
        ]);
    }
}

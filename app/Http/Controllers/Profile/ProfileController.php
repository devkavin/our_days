<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Photo;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function index()
    {
        // show profile page
        $profile = auth()->user();


        $profile_details = [
            'id' => $profile->id,
            'name' => $profile->name,
            'email' => $profile->email,

            'photos' => $profile->photos,
            'created_at' => $profile->created_at,
            'updated_at' => $profile->updated_at,
        ];

        $photos = Photo::getAllPhotos($profile->id);
        // dd($profile_details);
        // dd($profile);
        $public_photos = [];
        $private_photos = [];
        foreach ($photos as $photo) {
            if ($photo->is_public) {
                $public_photos[] = $photo;
            } else {
                $private_photos[] = $photo;
            }
        }

        $photos = [
            'public_photos' => $public_photos,
            'private_photos' => $private_photos,
            'all_photos' => $photos,
        ];

        return view('pages.profile.index')->with([
            'profile_details' => $profile_details,
            'profile' => $profile,
            'photos' => $photos,
        ]);
    }

    public function loadProfileDetails()
    {
        $profile = auth()->user();
        return response()->json([
            'profile' => $profile
        ]);
    }

    public function edit(Request $request, $id)
    {
        // dd($request->all(), $id);
        $profile = auth()->user();
        $profile_details = [
            'id' => $profile->id,
            'name' => $profile->name,
            'email' => $profile->email,

            'photos' => $profile->photos,
            'created_at' => $profile->created_at,
            'updated_at' => $profile->updated_at,
        ];
        $photo_types = Photo::PHOTO_TYPES;

        switch ($request->input('request')) {
            case 'edit_profile':

                return view('pages.profile.edit')->with([
                    'profile_details' => $profile_details,
                ]);
            case 'edit_photos':
                $photos = Photo::all();
                foreach ($photos as $photo) {
                    $photo->type_name = Photo::PHOTO_TYPES[$photo->type_id];
                }
                return view('pages.profile.photos.edit')->with([
                    'profile_details' => $profile_details,
                    'photos' => $photos,
                    'photo_types' => $photo_types,
                ]);
            default:
                return redirect()->route('profile.index');
        }
    }

    public function update(Request $request, $id)
    {
        dd($request->all(), $id);
        return redirect()->route('landing');
    }
}

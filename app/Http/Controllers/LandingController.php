<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;

class LandingController extends Controller
{
    public function index()
    {

        $photos = Photo::getPublicPhotos();
        // dd($photos);
        return view('landing')->with([
            'photos' => $photos,
        ]);
    }

    public function loadAccountNames()
    {
        $account_names = auth()->user()->account_names;
        return response()->json([
            'account_names' => $account_names
        ]);
    }
}

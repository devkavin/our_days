<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\SpotifyPlaylist;

class LandingController extends Controller
{
    public function index()
    {

        $photos = Photo::getPublicPhotos();
        $spotify_playlists = SpotifyPlaylist::getSpotifyPlaylists();
        // dd($spotify_playlists);
        return view('landing')->with([
            'photos' => $photos,
            'spotify_playlists' => $spotify_playlists,
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpotifyPlaylist extends Model
{
    use HasFactory;


    public static function getSpotifyPlaylists()
    {
        $spotify_playlists = [
            1 => [
                'id' => 1,
                'url' => 'https://open.spotify.com/playlist/7epBMTS97byWY1MCbnLC7E?si=851783ca99da485c',
                'src' => '7epBMTS97byWY1MCbnLC7E',
            ],
            2 => [
                'id' => 2,
                'url' => 'https://open.spotify.com/playlist/5wzLJs6LF4oouoYxCVfH0p?si=c2ed975eb7234751',
                'src' => '5wzLJs6LF4oouoYxCVfH0p',
            ],
            3 => [
                'id' => 4,
                'url' => 'https://open.spotify.com/playlist/5SzcNx8AWHdLdBrMOy7FPX?si=8dad739e4fc64de5',
                'src' => '5SzcNx8AWHdLdBrMOy7FPX',
            ],
            4 => [
                'id' => 5,
                'url' => 'https://open.spotify.com/playlist/71xHiLxCWKCvltSTPI1zhm?si=82cc9957af594c4a',
                'src' => '71xHiLxCWKCvltSTPI1zhm',
            ],
        ];

        return $spotify_playlists;
    }
}

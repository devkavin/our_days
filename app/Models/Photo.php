<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\FileHelper;

class Photo extends Model
{
    use HasFactory;

    const PHOTO_TYPE_PROFILE_PHOTO = 1;
    const PHOTO_TYPE_COVER_PHOTO = 2;
    const PHOTO_TYPE_USER_PHOTO = 3;
    const PHOTO_TYPE_POST_PHOTO = 4;
    const PHOTO_TYPES = [
        self::PHOTO_TYPE_PROFILE_PHOTO  => 'Profile photo', // s gets added to the end of the value in PhotoController when saving the image to the server
        self::PHOTO_TYPE_COVER_PHOTO    => 'Cover photo',
        self::PHOTO_TYPE_USER_PHOTO     => 'User photo',
        self::PHOTO_TYPE_POST_PHOTO     => 'Post photo',
    ];

    public static function getAllPhotos($user_id)
    {
        $photos = self::where('user_id', $user_id)->get();
        return $photos;
    }

    public static function getPublicPhotos()
    {
        $photos = self::where('is_public', true)->get();
        return $photos;
    }

    // public static function getPhotos()
    // {
    //     $photos = [
    //         1 => [
    //             'id' => 1,
    //             'url' => 'https://img.freepik.com/free-photo/modern-futuristic-sci-fi-background_35913-2150.jpg?w=1380&t=st=1703363770~exp=1703364370~hmac=ee092ae607f7941dbbb1bc6c2d653fd53307a61c8d7bfef15cf3279e8c26e0bd',
    //         ],
    //         2 => [
    //             'id' => 2,
    //             'url' => 'https://img.freepik.com/free-photo/colorful-beautiful-flowers-background-blossom-floral-bouquet-decoration-garden-flowers-plant-vertical-pattern-wallpapers-greeting-cards-postcards-design-wedding-invites_90220-1099.jpg?w=740&t=st=1703363951~exp=1703364551~hmac=c730c3974735cbd17a165e2097681ed4e4c26a81b208c9449703322c39d0f250',
    //         ],
    //         3 => [
    //             'id' => 3,
    //             'url' => 'https://img.freepik.com/free-photo/green-black-bugatti-veyron-with-black-yellow-paint_1340-23339.jpg?t=st=1703363986~exp=1703367586~hmac=a0a692561808e191930460b95250425d92bfc6d5a0f7405240ddfadbe59a3363&w=1380',
    //         ],
    //         4 => [
    //             'id' => 4,
    //             'url' => 'https://img.freepik.com/free-photo/illustration-tree-blossoms-with-abstract-pink-flowers-generated-by-ai_188544-10351.jpg?w=1380&t=st=1703364023~exp=1703364623~hmac=2f100030313b9bdc18e382eab88d449da1426f3fa801a267280089da3872f37e',
    //         ],
    //         5 => [
    //             'id' => 5,
    //             'url' => 'https://img.freepik.com/free-photo/painting-mountain-lake-with-mountain-background_188544-9126.jpg?w=1380&t=st=1703365614~exp=1703366214~hmac=34d5726dde694d09752981270ed29f5f871cdfef5ea2a596a06922c91244a04f',
    //         ],
    //         6 => [
    //             'id' => 6,
    //             'url' => 'https://img.freepik.com/free-photo/destroyed-city_456031-85.jpg?w=1380&t=st=1703365635~exp=1703366235~hmac=0b76a5ce633a2fb534280dd7e51376ed0337f2bb93b856d5b630820a5c687838',
    //         ],
    //         7 => [
    //             'id' => 7,
    //             'url' => 'https://img.freepik.com/free-photo/urban-landscape-people-japan_23-2148889524.jpg?w=1380&t=st=1703365658~exp=1703366258~hmac=e79ecd0092e6c587aba3adb71219f7bbb4e7cd56bdfe94a1bc443afebf5b4b75',
    //         ],
    //     ];

    //     return $photos;
    // }

    public function getUrlAttribute($value)
    {
        // changed globally to add a url to the image path (Used model accessor, so it will be applied to all images)
        // call this function to get the url of the image using the model
        return FileHelper::generateURL($value);
    }
}

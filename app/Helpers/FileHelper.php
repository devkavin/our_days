<?php


namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class FileHelper
{
    public static function generateURL($path)
    {
        if (!empty($path)) {
            $path = explode('public/', $path);
            $file_path = end($path);
            return config('app.url') . $file_path;
        }
        return null;
    }

    public static function saveImageWithURL($file, $destination_path): array
    {

        $originalFileName = $file->getClientOriginalName();
        $sanitizedFileName = preg_replace("/[^a-z0-9\_\-\.]/i", '', $originalFileName);
        $baseFileName = pathinfo($sanitizedFileName, PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();

        $counter = 1;
        $fileName = $sanitizedFileName;

        // Check if the file already exists, and if so, append a number to it
        while (file_exists($destination_path . '/' . $fileName)) {
            $fileName = $baseFileName . " (" . $counter . ")." . $extension;
            $counter++;
        }

        try {
            $file->move($destination_path, $fileName);
        } catch (\Exception $e) {
            // Handle the exception or log it for debugging
            Log::error('File upload error: ' . $e->getMessage());
            // Optionally, return or throw a custom error message
            return ['Error uploading file: ' . $e->getMessage()];
        }
        $saved_path = $destination_path . '/' . $fileName;

        $file_details = [
            'saved_path' => $saved_path,
            'saved_name' => $fileName,
            'extension' => $extension
        ];

        return $file_details;
    }
}

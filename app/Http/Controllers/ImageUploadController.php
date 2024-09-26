<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ImageUploadController extends Controller
{
    public function store(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|image|max:2048', // Adjust max size as needed
        ]);

        // Generate a unique folder name based on the current date
        $folderDate = date('m-Y');

        // Define the upload path
        $uploadPath = public_path('uploads/screenshots/' . $folderDate);

        // Ensure the directory exists
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        $file = $request->file('file');

        // Get the original filename with extension
        $originalFilename = $file->getClientOriginalName();

        // Sanitize the filename to prevent any security issues
        $filename = $this->sanitizeFilename($originalFilename);

        // Ensure the filename is unique to prevent overwriting existing files
        $filename = $this->makeFilenameUnique($uploadPath, $filename);

        // Move the file to the uploads/screenshots/{folderDate} directory
        $file->move($uploadPath, $filename);

        // Generate the URL to the uploaded image
        $imageUrl = asset('uploads/screenshots/' . $folderDate . '/' . $filename);

        // Return a JSON response with the image URL
        return response()->json(['location' => $imageUrl]);
    }

    /**
     * Sanitize the filename to remove any unwanted characters.
     *
     * @param string $filename
     * @return string
     */
    protected function sanitizeFilename($filename)
    {
        // Remove any directory paths
        $filename = basename($filename);

        // Replace spaces with underscores
        $filename = str_replace(' ', '_', $filename);

        // Remove any non-alphanumeric characters except underscores and dots
        $filename = preg_replace('/[^A-Za-z0-9_\-\.]/', '', $filename);

        // Limit the filename length
        $filename = substr($filename, 0, 200);

        return $filename;
    }

    /**
     * Make the filename unique if a file with the same name already exists.
     *
     * @param string $directory
     * @param string $filename
     * @return string
     */
    protected function makeFilenameUnique($directory, $filename)
    {
        $filepath = $directory . '/' . $filename;
        $fileInfo = pathinfo($filename);
        $basename = $fileInfo['filename'];
        $extension = isset($fileInfo['extension']) ? '.' . $fileInfo['extension'] : '';

        $counter = 1;

        // Append a number to the filename if it already exists
        while (file_exists($filepath)) {
            $newFilename = $basename . '_' . $counter . $extension;
            $filepath = $directory . '/' . $newFilename;
            $counter++;
        }

        return basename($filepath);
    }
}

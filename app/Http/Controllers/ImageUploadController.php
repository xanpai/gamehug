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
            'file' => 'required|image|max:5120', // Adjust max size as needed
        ]);

        // Generate a unique folder name based on the current date
        $folderDate = date('m-Y');

        // Get the uploaded file
        $file = $request->file('file');

        // Get the original filename with extension
        $originalFilename = $file->getClientOriginalName();

        // Sanitize the filename to prevent any security issues
        $sanitizedFilename = $this->sanitizeFilename($originalFilename);

        // Ensure the filename is unique to prevent overwriting existing files
        $uniqueFilename = $this->makeFilenameUnique(public_path('uploads/screenshots/' . $folderDate), $sanitizedFilename);

        // Get the filename without extension (for use in fileUpload)
        $filenameWithoutExtension = pathinfo($uniqueFilename, PATHINFO_FILENAME);

        // Generate the upload path
        $uploadPath = 'uploads/screenshots/' . $folderDate . '/';

        // Use the fileUpload helper function to process and save the image
        // Save as WebP
        $webpImage = fileUpload($file, $uploadPath, null, null, $filenameWithoutExtension, 'webp');
        // Save as original format
        $originalImage = fileUpload($file, $uploadPath, null, null, $filenameWithoutExtension);

        if ($webpImage && $originalImage) {
            // Generate the URLs to the uploaded images
            $webpUrl = url($uploadPath . $webpImage);
            $originalUrl = url($uploadPath . $originalImage);

            // Return a JSON response with the image URLs and filename
            return response()->json([
                'webp_location' => $webpUrl,
                'original_location' => $originalUrl,
                'filename' => $filenameWithoutExtension,
            ]);
        } else {
            // Handle upload failure
            return response()->json(['error' => 'Image upload failed'], 500);
        }
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

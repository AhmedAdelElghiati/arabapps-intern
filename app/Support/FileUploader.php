<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class FileUploader
{
    protected $resizeWidth;

    protected $resizeHeight;

    public function setSize($width, $height)
    {
        $this->resizeWidth = $width;
        $this->resizeHeight = $height;

        return $this;
    }

    public function save($file, $path)
    {
        ini_set('memory_limit', '512M');

        if (filter_var($file, FILTER_VALIDATE_URL)) {
            return $file;
        }

        // Non-image files (documents, archives, audio) are stored as-is; only
        // images go through the Intervention encode/resize pipeline below.
        $extension = strtolower($file->getClientOriginalExtension());
        if (! in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp'], true)) {
            return $file->storeAs($path, md5(uniqid()).'.'.$extension);
        }

        if ($this->resizeWidth) {
            $file = Image::make($file)
                ->resize($this->resizeWidth, $this->resizeHeight, function ($constraint) {
                    $constraint->aspectRatio();
                })->encode('png');
        } else {
            $file = Image::make($file)->encode('png');
        }

        $resizedImageName = md5($file->__toString().uniqid()).'.png';
        $path = $path.'/'.$resizedImageName;

        Storage::put($path, $file->__toString());

        return $path;
    }

    /**
     * Delete a stored file by its raw relative path. No-ops for empty values
     * and external URLs (which are referenced, not stored by us).
     */
    public function delete($path): void
    {
        if (empty($path) || filter_var($path, FILTER_VALIDATE_URL)) {
            return;
        }

        Storage::delete($path);
    }

    /**
     * Save a new uploaded file and delete the previously stored one (if any).
     * Chain ->setSize() first to resize. Returns the new stored relative path.
     */
    public function replace($file, $path, $oldPath = null)
    {
        $newPath = $this->save($file, $path);

        if ($oldPath && $oldPath !== $newPath) {
            $this->delete($oldPath);
        }

        return $newPath;
    }

    public function saveBase64Image($base64_image, $path, $ext = 'jpg')
    {
        ini_set('memory_limit', '512M');

        $base64_str = substr($base64_image, strpos($base64_image, ',') + 1);
        $image = base64_decode($base64_str);

        $imageName = md5(uniqid(true)).'.'.$ext;
        $path = $path.'/'.$imageName;

        Storage::put($path, $image);

        return $path;
    }

    public function saveBase64File($base64_file, $path, $type = 'svga')
    {
        ini_set('memory_limit', '512M');

        $base64_str = substr($base64_file, strpos($base64_file, ',') + 1);
        $image = base64_decode($base64_str);

        $imageName = md5(uniqid(true)).'.'.$type;

        $path = $path.'/'.$imageName;

        Storage::put($path, $image);

        return $path;
    }

    public function convertStringToImage($base64_image, $path, $ext = 'jpg')
    {
        ini_set('memory_limit', '512M');

        if (filter_var($base64_image, FILTER_VALIDATE_URL)) {
            return $base64_image;
        }
        // Decode the Base64 string into binary data
        $binaryData = base64_decode($base64_image);

        // Create an image object using Intervention Image
        $image = Image::make($binaryData);

        // Save the image to storage (optional)
        $imagePath = $path.'/'.uniqid().'.'.$ext;
        Storage::put($imagePath, $binaryData);

        return $imagePath;
    }

    public function convertBase64ToFile($base64String, $path, $ext = 'pdf')
    {
        ini_set('memory_limit', '512M');

        // Decode the Base64 string
        $binaryData = base64_decode($base64String);

        if ($binaryData === false) {
            throw new \Exception('Base64 decoding failed');
        }
        // Ensure the path exists
        Storage::makeDirectory($path);

        // Generate the full path (relative to the storage disk)
        $filePath = $path.'/'.uniqid().'.'.$ext;

        // Full save path using the storage path
        $savePath = storage_path('app/public/'.$filePath);

        // Save the file to the storage disk
        file_put_contents($savePath, $binaryData);

        return $filePath;
    }
}

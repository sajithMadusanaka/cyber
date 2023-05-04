<?php

namespace Domain\Services;

use Illuminate\Support\Facades\Storage;
use File;

class ImagesService
{
    public function storeImage($image): ?string
    {
        $path = null;
        $name = time()."student".$image->getClientOriginalName();
        $image = $image->move(public_path('uploads'),$name);
        if(file_exists('uploads/'.basename($image))) {
            $path = "uploads/".basename($image);
        }
        return $path;
    }

    public  function deleteImage($path): void
    {
        if (file_exists($path)) {
            File::delete(public_path($path));
        }
    }
}

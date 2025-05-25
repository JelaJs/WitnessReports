<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CreateFileService
{
    public function createFile($name, $phone_number)
    {
        $content = "Name: {$name}\nPhone: {$phone_number}\n---\n";
        $id = Str::random(8);

        Storage::disk('local')->append("{$name}-{$id}.txt", $content);
    }
}

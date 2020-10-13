<?php

namespace App\Traits;

use Auth;
use Storage;

trait UploadAvatar
{

    private $fileContent;
    private $fileExtension;
    private $mimeType;
    private $storagePath;
    private $VALID_IMAGES_TYPES = ["image/gif", "image/jpeg", "image/png"];

    private function getFileContent($encodedInput)
    {
        list($type, $data) = explode(';', $encodedInput);
        list(, $data)      = explode(',', $data);
        $this->fileContent = base64_decode($data);
    }

    private function getFileExtension()
    {
        $f                   = finfo_open();

        $this->mimeType      = finfo_buffer($f, $this->fileContent, FILEINFO_MIME_TYPE);

        $split               = explode('/', $this->mimeType);
        $this->fileExtension = $split[1];

    }

    private function isValidImage()
    {
        if (in_array($this->mimeType, $this->VALID_IMAGES_TYPES)) {
            return true;
        }
        return false;
    }

    private function storeFile($userId = null)
    {
        $filename = ($userId) ?? Auth::user()->id;

        $this->storagePath = $filename . "." . $this->fileExtension;
        //dd(public_path() . '/images/avatars/'.$this->storagePath);
        //  sdd(Storage::disk('avatars'));
        Storage::disk('local')->put('public/images/avatars/'.$this->storagePath, $this->fileContent);
    }

    private function saveAvatarForUser($user = null)
    {
         //dd('here1');
        $user = ($user) ?? Auth::user();
         //dd('here2');
        $this->storeFile($user->id);
        // dd('here3');
        $user->avatar = $this->storagePath;

        $user->save();
    }
}

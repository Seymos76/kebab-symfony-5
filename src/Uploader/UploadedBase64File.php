<?php


namespace App\Uploader;


use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadedBase64File extends UploadedFile
{
    public function __construct(string $base64String, string $originalName, string $mimeType = null, int $error = null, bool $test = false)
    {
        $extension = substr($base64String, 11, strlen($base64String));
        dump('extension',$extension);
        $filePath = tempnam(sys_get_temp_dir(), 'UploadedFile');
        $data = base64_decode($base64String);
        $filePutContents = file_put_contents($filePath, $data);
        dump('filePath',$filePath,'data',$data,'base64string',$base64String,'fileputcontents',$filePutContents);
        $error = null;
        $mimeType = "image/{$extension}";
        $test = true;
        parent::__construct($filePath, $originalName, $mimeType);
    }
}

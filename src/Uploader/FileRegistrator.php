<?php


namespace App\Uploader;


use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileRegistrator
{
    private $base64FileExtractor;

    public function __construct(Base64FileExtractor $base64FileExtractor)
    {
        $this->base64FileExtractor = $base64FileExtractor;
    }

    public function get(string $base64File, string $slug): UploadedFile
    {
        // extract base64
        $base64Image = $this->base64FileExtractor->extractBase64String($base64File);
        $extension = substr($base64Image, 11, strlen($base64Image));
        dump('extension',$extension);
        // extract meta info
        //$imageMeta = $this->base64FileExtractor->extractMetaString($base64File);
        //$base64=str_replace('data:image/png;base64,', '', $base64Image);
        return new UploadedBase64File($base64Image, $slug.".{$extension}");
    }
}

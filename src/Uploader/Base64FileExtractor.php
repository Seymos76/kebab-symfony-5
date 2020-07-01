<?php


namespace App\Uploader;


class Base64FileExtractor
{
    public function extractBase64String(string $base64Content): string
    {
        $data = explode( ';base64,', $base64Content);
        return $data[0];
    }

    public function extractMetaString(string $base64Content): string
    {
        return explode('data:', $base64Content, 1)[0];
    }
}

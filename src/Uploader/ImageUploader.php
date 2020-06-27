<?php


namespace App\Uploader;


use App\Generator\UniqueFileNameGenerator;
use PHPUnit\Exception;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageUploader
{
    public function handleFileUpload(UploadedFile $uploadedFile, ?string $directory): string
    {
        if (!$uploadedFile || !$uploadedFile instanceof UploadedFile) {
            return false;
        }
        $generator = new UniqueFileNameGenerator('default', null, null);
        $brochureFileName = $this->upload($uploadedFile, $directory, $generator);
        $file = new File($directory.'/'.$brochureFileName);
        return $file->getPathname();
    }

    public function upload(UploadedFile $uploadedFile, string $directory, ?UniqueFileNameGenerator $uniqueFileNameGenerator, ?string $fileName = null)
    {
        // generate unique filename
        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        //dd($uniqueFileNameGenerator);
        $fileName = $originalFilename.'-'.uniqid().'.'.$uploadedFile->guessExtension();
        //$filename = $uniqueFileNameGenerator->generate($originalFilename);
        //dd($fileName);
        // move file to dist directory
        try {
            $uploadedFile->move($directory, $fileName);
        } catch (Exception $exception) {
            throw new FileException($exception->getMessage());
        }
        // return filename
        return $fileName;
    }
}

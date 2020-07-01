<?php


namespace App\Uploader;


use App\Generator\UniqueFileNameGenerator;
use PHPUnit\Exception;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageUploader
{
    protected $targetDirectory;

    public function __construct()
    {
        $this->targetDirectory = __DIR__.'/../../public/uploads/fixtures';
    }

    public function handleFileUpload(UploadedFile $uploadedFile, ?string $directory): string
    {
        if (!$uploadedFile || !$uploadedFile instanceof UploadedFile) {
            return false;
        }
        $generator = new UniqueFileNameGenerator('default', null, null);
        $brochureFileName = $this->uploadTo($uploadedFile, $directory, $generator);
        $file = new File($directory.'/'.$brochureFileName);
        return $file->getPathname();
    }

    public function uploadTo(UploadedFile $uploadedFile, string $directory, ?UniqueFileNameGenerator $uniqueFileNameGenerator, ?string $fileName = null)
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

    public function upload(File $uploadedFile)
    {
        dump('uploadedFile',$uploadedFile);
        if ($uploadedFile instanceof UploadedFile) {
            $originalFilename = $uploadedFile->getClientOriginalName();
        } else {
            $originalFilename = pathinfo($uploadedFile->getFilename(), PATHINFO_FILENAME);
        }
        dump('originalFilename',$originalFilename);
        $fileName = $originalFilename.'.'.$uploadedFile->guessExtension();
        dump('filename',$fileName);
        try {
            $uploadedFile->move($this->targetDirectory, $originalFilename);
        } catch (Exception $exception) {
            throw new FileException($exception->getMessage());
        }
        // return filename
        return $fileName;
    }
}

<?php
namespace App\Service;


use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class FileUploader
{
    private $logger;
    public function __construct(LoggerInterface $logger)
    {
        $this->logger=$logger;
    }

    public function upload($uploadDir, $file, $filename){
        try {
            $file->move($uploadDir, $filename);
            return true;
        }catch (FileException $exception){
            return false;
        }
    }
}

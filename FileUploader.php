<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Psr\Log\LoggerInterface;

class FileUploader 
{
    private $logger;

    public function __construct(LoggerInterface $logger) 
    {
        $this->logger = $logger;
    }

    public function upload($uploadDir, $file, $filename) 
    {
        try {
            $file->move($uploadDir, $filename);
        } catch (FileException $e){

            $this->logger->error('failed to upload image: ' . $e->getMessage());
        }
    }

    public function getSize($uploadDir, $filename){
        try {
            return filesize($uploadDir . "/" .$filename);
        } catch (FileException $e){

            $this->logger->error('failed to get image size: ' . $e->getMessage());
        }
    }
} 

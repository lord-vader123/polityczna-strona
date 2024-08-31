<?php

class FileHandler {
    private string $filePath, $fileType; 
    private ?string $finalPath = null;
    private array $file;
    
    public function __construct(string $dirName, array $file) {
        
        if (!isset($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
            throw new Exception('Invalid file data provided');
        }


        $this->filePath = __DIR__ . '/../../assets/'. $dirName;
        $this->file = $file;

        $finfo = new finfo(FILEINFO_EXTENSION);
        $this->fileType = $finfo->file($file['name']);
        unset($finfo);
    }
    
    public function saveFile() : bool {
        $maxAttempts = 20;
        $currentAttempt = 0;
        while ($maxAttempts > $currentAttempt) {
            $savePath = $this->filePath . $this->generateRandomName(20) . '.' . $this->fileType ;
            if (!file_exists($savePath)) {
                if (move_uploaded_file($this->file['tmp_name'], $savePath)) {
                    $this->finalPath = $savePath;
                    return true;
                } else {
                    throw new Exception('Failed saving file');
                }
            }
            $currentAttempt++;
        }
        return false;
    }
    
    public function getFinalPath() : string {
        return $this->finalPath ?? throw new Exception('Final path not set');
    }
    
    private function generateRandomName(int $lenght) : string {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $name = '';
        for ($i = 0; $i < $lenght; $i++) {
            $name .= $chars[random_int(0, strlen($chars) -1)];
        }
        return trim($name);

    }

    
    
}
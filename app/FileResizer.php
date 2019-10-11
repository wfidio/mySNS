<?php

namespace App;

class FileResizer
{
    public $originalFile;

    public function __construct($originalFile){
        $this->originalFile = $originalFile;
    }

    public function resize($new_width,$targetFile){
        $info = \getimagesize($this->originalFile);
        $mime = $info['mime'];

        switch($mime){
            case 'image/jpeg':
                $image_create_func = 'imagecreatefromjpeg';
                $image_save_func = 'imagejpeg';
                // $ext = 'jpg';
            break;
            case 'image/png':
                $image_create_func = 'imagecreatefrompng';
                $image_save_func = 'imagepng';
                // $ext = 'png';
            break;
            case 'image/gif':
                $image_create_func = 'imagecreatefromgif';
                $image_save_func = 'imagegif';
                // $ext = 'gif';
            case 'image/bmp':
                $image_create_func = 'imagecreatefrombmp';
                $image_save_func = 'imagebmp';
                // $ext = 'bmp';
            break;
            default:
            throw new Exception('Unknown Image Type');
        }

        $img = $image_create_func($this->originalFile);
        list($width,$height) = \getimagesize($this->originalFile);

        $new_height = $new_width * ($height / $width);
        $temp = \imagecreatetruecolor($new_width,$new_height);
        \imagecopyresampled($temp,$img,0,0,0,0,$new_width,$new_height,$width,$height);

        if(\file_exists($targetFile)){
            unlink($targetFile);
        }

        $image_save_func($temp,$targetFile);

    }
}
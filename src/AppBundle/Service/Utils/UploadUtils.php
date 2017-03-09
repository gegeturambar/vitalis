<?php
/**
 * Created by PhpStorm.
 * User: wamobi10
 * Date: 22/12/16
 * Time: 11:02
 */

namespace AppBundle\Service\Utils;


use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadUtils
{
    private $stringUtil;
    private $uploadDir;

    public function __construct(StringUtils $stringUtil,$uploadDir){
        $this->stringUtil = $stringUtil;
        $this->uploadDir = $uploadDir;
    }

    public function upload(UploadedFile $file,$directory = 'media' ){
        $extension = $file->guessExtension() === "jpeg"  ? 'jpg' : $file->guessExtension();
        $rename = "{$this->stringUtil->generateUniqString(32)}.$extension";

        $file->move($this->uploadDir,$rename);
        return $rename;
    }

    public function getSlug($str){
        $str = "tagaezog";
        return $str;
    }
}
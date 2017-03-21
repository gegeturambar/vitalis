<?php
/**
 * Created by PhpStorm.
 * User: wamobi10
 * Date: 22/12/16
 * Time: 11:02
 */

namespace AppBundle\Service\Utils;


use Symfony\Component\Config\Definition\Exception\Exception;

class DirectoryUtils
{
    private $fileUtils;

    public function __construct(FileUtils $fileUtils){
        $this->fileUtils = $fileUtils;
    }

    /**
     * Read a directory and return all files with a specific extension
     * @param string $path
     * @param string $extension
     * @return array $errors
     */
    public function ProcessDirectory( $path, $extension = null ){
        if(!is_dir($path))
            throw new Exception("the path specified is not a directory => $path");
        $extension = is_null($extension) ? "": "*.$extension";

        $files = glob($path.'/'.$extension);
        $errors = array();
        foreach($files as $file){
            try {
                $errors[$file] = $this->fileUtils->ProcessFile($file);
            }catch (Exception $exception){
                $errors[$file] = $exception;
            }
        }
        return $errors;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: wamobi10
 * Date: 22/12/16
 * Time: 11:02
 */

namespace AppBundle\Service\Utils;

use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\Config\Definition\Exception\Exception;

class FileUtils
{

    private $xmlRecordUtils;
    private $doctrine;

    public function __construct(Registry $doctrine, XmlRecordUtils $xmlRecordUtils){
        $this->xmlRecordUtils = $xmlRecordUtils;
        $this->doctrine = $doctrine;
    }

    /**
     * Process the file
     * @param $file
     * @return array $errors
     */
    public function ProcessFile($file){
        $errors = array();
        // check if file is readable, read it and process it
        if(!file_exists($file))
            throw new Exception("The file $file does not exists");

        $rc = $this->doctrine->getRepository("AppBundle::User");

        // get user, then get each line
        $lines = file_get_contents($file);
        foreach($lines as $line) {
            // check wich line, get the user
            $username = $line;
            $user = $rc->findByName($username);
            try {
                $this->xmlRecordUtils->ProcessRecord($line,$user);
            }catch(Exception $exception){
                $errors[] = $exception;
            }
        }
        return $errors;

    }
}
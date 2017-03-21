<?php
/**
 * Created by PhpStorm.
 * User: jeremie
 * Date: 19/03/17
 * Time: 11:05
 */

namespace AppBundle\Service\Utils;
require_once 'PHPUnit/Autoload.php';

class DirectoryUtilsTest extends \PHPUnit\Framework\TestCase
{
    public function testProcessDirectoryMock(){
        $mock = $this->createMock(FileUtils::class);
        $directory = new DirectoryUtils($mock);
        $path = 'var/xml';
        $ret = $directory->ProcessDirectory($path);
        $this->assertEquals(count($ret),1);
    }

    public function testProcessDirectoryAll(){

        $fileUtils = new FileUtils();
        $directory = new DirectoryUtils($mock);
        $path = 'var/xml';
        $ret = $directory->ProcessDirectory($path);
        $this->assertEquals(count($ret),1);
    }
}

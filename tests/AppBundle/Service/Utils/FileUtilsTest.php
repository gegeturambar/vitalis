<?php
/**
 * Created by PhpStorm.
 * User: jeremie
 * Date: 19/03/17
 * Time: 11:06
 */

namespace AppBundle\Service\Utils;


use Doctrine\Bundle\DoctrineBundle\Registry;

class FileUtilsTest extends \PHPUnit_Framework_TestCase
{
    public function testProcessFileMock(){
        //Registry $doctrine, XmlRecordUtils $xmlRecordUtils
        $xmlMock = $this->createMock(XmlRecordUtils::class);
        $registryMock = $this->createMock(Registry::class);
        $file = new FileUtils($registryMock,$xmlMock);
        $path_file = '/var/xml/realfiletest.xml';
        $ret = $file->ProcessFile($path_file);
        $this->assertEquals(count($ret),1);
    }
}

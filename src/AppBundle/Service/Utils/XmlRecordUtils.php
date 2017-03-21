<?php
/**
 * Created by PhpStorm.
 * User: wamobi10
 * Date: 22/12/16
 * Time: 11:02
 */

namespace AppBundle\Service\Utils;

use AppBundle\Entity\User;
use AppBundle\Entity\XmlRecord;
use Symfony\Component\Config\Definition\Exception\Exception;

class XmlRecordUtils
{

    private $mailUtils;
    private $doctrine;

    public function __construct(MailUtils $mailUtils){
        $this->mailUtils = $mailUtils;
    }

    /**
     * Process the file
     * @param $file
     * @return bool
     */
    public function ProcessRecord($record,User $user){
        $xmlRecord = new XmlRecord($record);

        // here, we check if the mail has to to be send, and if yes, wich template should be used
        $templatePath = 'Emails/standard.html.twig';
        return $this->mailUtils->SendMail($xmlRecord,$user,$templatePath);
    }
}
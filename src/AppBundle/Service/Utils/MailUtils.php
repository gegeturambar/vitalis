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

class MailUtils
{

    private $twig;
    private $mailer;

    public function __construct(\Twig_Environment $twig, \Swift_Mailer $mailer)
    {
        $this->twig = $twig;
        $this->mailer = $mailer;
    }

    /**
     * Send the mail
     * @param $user
     * @return bool
     */
    public function SendMail(XmlRecord $xmlRecord,User $user, string $path){


        $message = \Swift_Message::newInstance()
            ->setSubject('Hello Email')
            ->setFrom($user->getUsername())
            ->setTo($xmlRecord->getClientEmail())
            ->setBody(
                $this->twig->render(
                // app/Resources/views/Emails/registration.html.twig
                //    'Emails/registration.html.twig',
                    $path,
                    array('xmlRecord' => $xmlRecord)
                ),
                'text/html'
            )
            /*
             * If you also want to include a plaintext version of the message
            ->addPart(
                $this->renderView(
                    'Emails/registration.txt.twig',
                    array('name' => $name)
                ),
                'text/plain'
            )
            */
        ;
        return $this->mailer->send($message);
    }
}
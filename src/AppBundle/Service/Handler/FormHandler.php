<?php
/**
 * Created by PhpStorm.
 * User: wamobi10
 * Date: 21/12/16
 * Time: 12:16
 */

namespace AppBundle\Service\Handler;


use AppBundle\Service\Utils\StringUtils;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\Form\FormInterface;

class FormHandler
{
    protected $form;
    protected $doctrine;
    protected $stringUtil;

    public function __construct(Registry $doctrine,StringUtils $stringUtils){
        $this->stringUtil = $stringUtils;
        $this->doctrine = $doctrine;
    }

    public function check(FormInterface $form){
        $this->form = $form;
        return $form->isValid() && $form->isSubmitted();
    }

    public function process(){
        try {
            // récupération d'une instance
            $data = $this->form->getData();
            //dump($data);

            // pour INSERT, DELETE, UPDATE
            $em = $this->doctrine->getManager();

            // persist : persistance des donn�es // requ�te en file d'attente

            $em->persist($data);

            // flush : ex�cution des requ�tes
            $em->flush();

        }catch(Exception $ex){
            return false;
        }
        return true;
    }

    public function delete($entity){

        if(is_null($entity))
            return false;
        // pour INSERT, DELETE, UPDATE
        $em  = $this->doctrine->getManager();

        try {
            $em->remove($entity);
            $em->flush();
        }catch(Exception $ex) {
            return false;
        }
        return true;
    }

}
<?php

namespace AppBundle\Listener;

use AppBundle\Entity\Parameter;
use AppBundle\Service\Utils\StringUtils;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\Form\Util\StringUtil;

class ParameterListener{

    private $stringUtils;
    private $pathUpload;

    public function __construct(StringUtils $stringUtils,$pathUpload)
    {
        $this->stringUtils = $stringUtils;
        $this->pathUpload = $pathUpload;
    }




    public function prePersist(Parameter $parameter, LifecycleEventArgs $event){
        $name = $event->getObject()->getName();
        $value = $event->getObject()->getValue();
        $isImage = $event->getObject()->getIsImage();
        $parameter->setSlug($this->stringUtils->getSlug($name));
    }

    public function postLoad(Parameter $parameter, LifecycleEventArgs $event){

    }

    public function preUpdate(Parameter $parameter, PreUpdateEventArgs $event){
        $name = $event->getObject()->getName();
        $value = $event->getObject()->getValue();
        $isImage = $event->getObject()->getIsImage();
        $parameter->setSlug($this->stringUtils->getSlug($name));

        if($isFile) {
            $file = $value;
            if (!$file) {
            } else {
                unlink($this->pathUpload . $parameter->oldimg);
            }
        }
    }

    public function postRemove(Parameter $parameter, LifecycleEventArgs $event){
        $img = $parameter->getPortrait();
        if($img && file_exists($this->pathUpload.$parameter->getPortrait())){
            unlink($this->pathUpload.$img);
        }
    }

}
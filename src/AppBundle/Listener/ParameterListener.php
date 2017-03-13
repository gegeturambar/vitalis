<?php

namespace AppBundle\Listener;

use AppBundle\Entity\Parameter;
use AppBundle\Service\Utils\StringUtils;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\Form\Util\StringUtil;
use Symfony\Component\HttpFoundation\File\File;

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

        $parameter->setLastModification(new \DateTime());
    }

    public function postLoad(Parameter $parameter, LifecycleEventArgs $event){
        $parameter->oldImg = $parameter->getIsImage() ? $parameter->getValue() : null;
    }

    public function preUpdate(Parameter $parameter, PreUpdateEventArgs $event){

        $name = $event->getObject()->getName();
        $value = $event->getObject()->getValue();
        $isImage = $event->getObject()->getIsImage();

        $parameter->setSlug($this->stringUtils->getSlug($name));

        if($isImage) {
            $file = $value;

            if(!is_object($file) || !get_class($file) == File::class) {
                $value = null;
                return;
            }
            if ($file) {
                $filename = sha1(uniqid(mt_rand(), true)).".".$file->guessExtension();
                //$path = $this->pathUpload.$filename;
                $file->move($this->pathUpload,$filename);
                $parameter->setValue($filename);
            }
        }

        if( $parameter->oldImg && $parameter->oldImg != $parameter->getValue()) {
            $oldPath = $this->pathUpload . $parameter->oldImg;
            if (file_exists($oldPath))
                unlink($oldPath);
        }
    }

    public function postRemove(Parameter $parameter, LifecycleEventArgs $event){
        $img = $parameter->getValue();
        if($img && file_exists($this->pathUpload.$img)){
            unlink($this->pathUpload.$img);
        }
    }

}
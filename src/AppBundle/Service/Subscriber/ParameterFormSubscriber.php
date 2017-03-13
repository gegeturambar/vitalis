<?php
/**
 * Created by PhpStorm.
 * User: wamobi10
 * Date: 22/12/16
 * Time: 09:40
 */

namespace AppBundle\Service\Subscriber;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\NotBlank;

class ParameterFormSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return [
           FormEvents::POST_SET_DATA => 'postSetData',
            FormEvents::PRE_SUBMIT => 'preSubmit'
        ];
    }

    public function preSubmit(FormEvent $event){
        /**
         * @var $form Form
         */
        $form = $event->getForm();  // le formulaire
        $data = $form->getData();

        $entity = $event->getData(); // entity présente en bdd

        if(!$entity['isImage'] ){
            $form->remove('value');
            $form->add('value'
            );
        }
    }
/*
    public function preSubmit(FormEvent $event){

        $form = $event->getForm();  // le formulaire
        $data = $form->getData();

        $entity = $event->getData(); // entity présente en bdd

        if($entity->getIsImage()) {
            $entity->oldfile = $entity->getValue();
            $id = $entity->getId();
            $constraints = array(
                new NotBlank(['message' => "image_required"]),
                new Image(['minWidth' => 100,
                    'maxWidth' => 4000,
                    'minHeight' => 100,
                    'maxHeight' => 4000,
                    'mimeTypes' => array("image/png", "image/jpeg")
                ])
            );
            $form->add('value', FileType::class,
                array(
                    'constraints' => $constraints,
                    'data_class' => null
                )
            );
        }else{
            $form->add('value');
        }

    }
*/
    public function postSetData(FormEvent $event){

        $form = $event->getForm();  // le formulaire
        $data = $form->getData();

        $entity = $event->getData(); // entity présente en bdd

        if($entity->getIsImage()) {
            $entity->oldfile = $entity->getValue();
            $id = $entity->getId();
            $constraints = array(
                new Image(['minWidth' => 100,
                    'maxWidth' => 4000,
                    'minHeight' => 100,
                    'maxHeight' => 4000,
                    'mimeTypes' => array("image/png", "image/jpeg")
                ])
            );
            $form->add('value', FileType::class,
                array(
                    'constraints' => $constraints,
                    'data_class' => null
                )
            );
        }else{
            $form->add('value');
        }
    }
        /*
        $constraints = !$id ? array(
            new NotBlank(['message'=>"portrait_required"]),
            new Image(['minWidth'=> 100,
                    'maxWidth' => 4000,
                    'minHeight'=> 100,
                    'maxHeight' => 4000,
                    'mimeTypes' => array("image/png","image/jpeg")
                ])
            ) : array();
        $form->add('poster',FileType::class,
            array(
                'constraints'=>$constraints,
                'data_class' => null
            )
        );
        */

}

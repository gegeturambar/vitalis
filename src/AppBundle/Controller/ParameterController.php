<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\Parameter;
use AppBundle\Form\ParameterType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin/parameter")
 */
class ParameterController extends Controller
{

    /**
    * @Route("/", name="app.admin.parameter.index")
    */
    public function indexAction(Request $request)
    {
        $doctrine = $this->getDoctrine();
        $rep = $doctrine->getRepository("AppBundle:Parameter");
        $records = $rep->findAll();

        // replace this example code with whatever you need
        return $this->render('admin/parameter/index.html.twig', ['records'=>$records
        ]);
    }

    /**
     * @Route("/form", name="app.admin.parameter.form")
     * @Route("/form/update/{id}", name="app.admin.parameter.form.update",requirements={"id"="\d+"})
     */
    public function formAction(Request $request, $id = null){

        $doctrine = $this->getDoctrine();

        // pour INSERT, DELETE, UPDATE
        $em  = $doctrine->getManager();

        // Pour select
        $rc = $doctrine->getRepository("AppBundle:Parameter");

        // create form
        $entity = is_null($id) ? new Parameter() : $rc->find($id);
        $entityType = ParameterType::class;

        $formHandler = $this->get('app.services.handler');

        $form = $this->createForm($entityType,$entity);

        // prends en charge la requête
        $form->handleRequest($request);

        if($formHandler->check($form)){

            if($formHandler->process()) {
                $msgType = 'notice';
                $msg = is_null($id) ? ucfirst($this->get('translator')->trans("parameter.flash_messages.add")) : ucfirst($this->get('translator')->trans("actor.flash_messages.update"));
            }else{
                $msgType = 'error';
                $msg = is_null($id) ? ucfirst($this->get('translator')->trans("parameter.flash_messages.add")) : ucfirst($this->get('translator')->trans("actor.flash_messages.update"));
            }
            $this->addFlash($msgType,$msg);
            return $this->redirectToRoute('app.admin.parameter.index');
        }

        // envoi du formulaire sous form de html
        return $this->render('admin/parameter/form.html.twig', array('form'=>$form->createView()

        ));
    }

    /**
     * @Route("/form/delete/{id}", name="app.admin.parameter.form.delete",requirements={"id"="\d+"})
     */
    public function deleteAction(Request $request,$id = null)
    {
        $doctrine = $this->getDoctrine();

        // pour INSERT, DELETE, UPDATE
        $em  = $doctrine->getManager();

        // Pour select
        $rc = $doctrine->getRepository("AppBundle:Parameter");

        // create form
        $entity = $rc->find($id);

        $formHandler = $this->get('app.services.handler');

        if($formHandler->delete($entity)){
            $msgtype = "notice";
            $msg = ucfirst($this->get('translator')->trans("parameter.flash_messages.delete"));
        }else{
            $msgtype = "error";
            $msg = ucfirst($this->get('translator')->trans("parameter.flash_messages.delete_fail"));

        }
        /*

         */
        $this->addFlash($msgtype,$msg);
        return $this->redirectToRoute('app.admin.parameter.index');
    }

}

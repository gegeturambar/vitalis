<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class SecurityController extends Controller
{
    /**
     * @Route("/login", name="app.security.login")
     */
    public function loginAction(Request $request)
    {

        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    /**
     * @Route("/logout", name="app.security.logout")
     */
    public function logoutAction(Request $request)
    {

    }

    /**
     * @Route("/security/update/{id}", name="app.security.update",requirements={"id"="\d+"})
     * @Route("/security/create", name="app.security.create")
     */
    public function createAction(Request $request, $id = null){

        $doctrine = $this->getDoctrine();

        // pour INSERT, DELETE, UPDATE
        $em  = $doctrine->getManager();

        // Pour select
        $rc = $doctrine->getRepository("AppBundle:User");

        // create form
        $entity = is_null($id) ? new User() : $rc->find($id);
        $entity = new User();
        $entityType = UserType::class;

        $formHandler = $this->get('app.services.userhandler');

        $form = $this->createForm($entityType, $entity);

        // prends en charge la requête
        $form->handleRequest($request);

        if($formHandler->check($form)){

            if($formHandler->process()){

                $message = \Swift_Message::newInstance()
                    ->setTo('9b8f91a58e-b441e5@inbox.mailtrap.io')
                    ->setFrom('send@example.com')
                    ->setSubject('Hello Email')
                    ->setBody('ffff')
                ;

                $this->get('mailer')->send($message);


                $msgType = 'notice';
                $msg = is_null($id) ? ucfirst($this->get('translator')->trans("movie.flash_messages.add")) : ucfirst($this->get('translator')->trans("movie.flash_messages.update"));

            }else{
                $msgType = 'error';
                $msg = is_null($id) ? ucfirst($this->get('translator')->trans("movie.flash_messages.add")) : ucfirst($this->get('translator')->trans("movie.flash_messages.update"));
            }
            $this->addFlash($msgType,$msg);
            return $this->redirectToRoute('app.homepage.index');
        }

        // envoi du formulaire sous form de html
        return $this->render('security/form.html.twig', array('form'=>$form->createView()

        ));


    }
}

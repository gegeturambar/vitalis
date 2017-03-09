<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomepageController extends Controller
{
    /**
     * @Route("/", name="app.homepage.index")
     */
    public function indexAction(Request $request)
    {
        /*
        $doctrine = $this->getDoctrine();
        $rc = $doctrine->getRepository('AppBundle:Movie');
        $results = $rc->getMoviesByDate();

        // replace this example code with whatever you need
        return $this->render('homepage/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            'mydate'=> '1934-12-12',
            'results'   =>  $results
        ]);
        */
        return $this->render('homepage/index.html.twig', [
        ]);
    }
}

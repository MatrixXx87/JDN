<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JeuxController extends AbstractController
{

    /**
     * @Route("/jeux", name="jeux.index")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('jeux/index.html.twig',[
            'current_menu' => 'jeux'
            ]);
    }

}
<?php

namespace App\Controller;

use App\Repository\JeuxRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class HomeController extends AbstractController

{
    /**
     * @Route("/",name="home")
     * @param  JeuxRepository $repository
     * @return Response
     */

    public function index(JeuxRepository $repository):Response
    {
        $jeux =$repository->findLatest();
        return $this->render('pages/home.html.twig',[
            'jeux' => $jeux
            ]);
    }

}


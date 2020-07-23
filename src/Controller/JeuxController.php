<?php

namespace App\Controller;

use App\Entity\Jeux;
use App\Repository\JeuxRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JeuxController extends AbstractController
{
    /**
     * @var JeuxRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(JeuxRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

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


     /**
     * @Route("/jeux/{slug}-{id}", name="jeux.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param jeux $jeux
     * @return Response
     */
    public function show(Jeux $jeux, string $slug): Response
    {
        if ($jeux->getSlug() !== $slug) {
            return $this->redirectToRoute('jeux.show', [
                'id' => $jeux->getId(),
                'slug' => $jeux->getSlug()
            ], 301);
        }
        return $this->render('pages/show.html.twig', [
            'jeux' => $jeux,
            'current_menu' => 'jeux'
        ]);
    }

}
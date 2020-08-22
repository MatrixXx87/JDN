<?php

namespace App\Controller;

use App\Repository\JeuxRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Jeux;
use App\Form\JeuxType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminjeuxController extends AbstractController
{
    /**
     * @var JeuxRepository
     */
    private $JeuxRepository;

    public function __construct(JeuxRepository $JeuxRepository, EntityManagerInterface $em)
    {
        $this->repository = $JeuxRepository;
        $this->em = $em;
    }

    /**
     * @Route("/admin/jeux/create", name="admin.jeux.new")
     */
    public function new(Request $request)
    {
        $jeux = new Jeux();
        $form = $this->createForm(JeuxType::class, $jeux);
        $form -> handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $this->em->persist($jeux);
            $this->em->flush();
            $this->addFlash('success', 'L enregistrement a bien ete pris en compte');
            return $this->redirectToRoute('admin.jeux.index');
        }
        return $this->render('adminjeux/new.html.twig', [
            'jeux'=> $jeux,
            'form'=> $form->createView()
        ]);
    }

    /**
     * @Route("/admin", name="admin.jeux.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $jeux = $this->repository->findAll();
        return $this->render('adminjeux/index.html.twig', compact('jeux'));
    }

    /**
     * @Route("/admin/jeux/{id}", name="admin.jeux.edit", methods="GET|POST")
     * @param jeux $jeux
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Jeux $jeux, Request $request)
    {
        $form = $this->createForm(JeuxType::class, $jeux);
        $form -> handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'La modification a bien ete pris en compte');
            return $this->redirectToRoute('admin.jeux.index');
        }


        return $this->render('adminjeux/edit.html.twig', [
            'jeux'=> $jeux,
            'form'=> $form->createView()
        ]);
    }

    /**
     * @Route("/admin/jeux/{id}", name="admin.jeux.delete" , methods="DELETE")
     * @param Jeux $jeux
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(Jeux $jeux , Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $jeux->getId(), $request->get('_token'))) {
            $this->em->remove($jeux);
            $this->em->flush();
            $this->addFlash('success', 'La suppression a bien ete pris en compte');
        }
        return $this->redirectToRoute('admin.jeux.index');
    }


}

<?php

namespace App\Controller;

use App\Entity\Jeux;
use App\Entity\JeuxSearch;
use App\Form\JeuxSearchType;
use App\Repository\JeuxRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\Tools\Pagination\Paginator;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Notification\ContactNotification;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

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
    public function index( PaginatorInterface $paginator, Request $request): Response
    {
        $search = new JeuxSearch();
        $form = $this->createForm(JeuxSearchType::class, $search);
        $form->handleRequest($request);

        $jeux = $paginator->paginate (
            $this->repository->findAllVisibleQuery($search),
            $request->query->getInt('page', 1),
            7
        );

        return $this->render('jeux/index.html.twig',[
            'current_menu' => 'jeux',
            'jeux' => $jeux ,
            'form' => $form->createView()
            ]);
    }


     /**
     * @Route("/jeux/{slug}-{id}", name="jeux.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param jeux $jeux
     * @return Response
     */
    public function show(Jeux $jeux, string $slug, Request $request, ContactNotification $notification, MailerInterface $mailer): Response
    {
        if ($jeux->getSlug() !== $slug) {
            return $this->redirectToRoute('jeux.show', [
                'id'   => $jeux->getId(),
                'slug' => $jeux->getSlug()
            ], 301);
        }

        $contact = new Contact();
        $contact->setProperty($jeux);
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email = (new Email())
                ->from('test@gmail.com')
                ->to ('you@exemple.com')
                ->subject('Time for Symfony Mailer!')
                ->text('Sending emails is fun again!')
                ->html('<p>See Twig integration for better HTML integration!</p>');

                $mailer->send($email);

            $this->addFlash('success', 'Votre email a bien été envoyé');
            return $this->redirectToRoute('jeux.show', [
                'id'   => $jeux->getId(),
                'slug' => $jeux->getSlug()
            ]);
        }

        return $this->render('pages/show.html.twig', [
            'jeux'         => $jeux,
            'current_menu' => 'jeux',
            'form'         => $form->createView()
        ]);
    }

}

<?php

namespace App\Controller;

use App\Entity\Review;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/about', name: 'about')]
    public function about(): Response
    {
        return $this->render('home/about.html.twig');
    }

    #[Route('/contact', name: 'contact')]
    public function contact(): Response
    {
        return $this->render('home/contact.html.twig');
    }

    #[Route('/residential', name: 'residential')]
    public function residential(): Response
    {
        return $this->render('home/residential.html.twig');
    }


    #[Route('/compliance', name: 'compliance')]
    public function compliance(): Response
    {
        return $this->render('home/compliance.html.twig');
    }

    #[Route('/register', name: 'register')]
    public function register(Request $request, ): Response
    {
        if ($request->isMethod('POST')) {
            $user = new User();

            $user->setFirstName($request->get('firstName'));
            $user->setLastName($request->get('lastName'));
            $user->setEmail($request->get('email'));
            $user->setPassword($request->get('password'));
            $user->setTelNumber($request->get('telNumber'));
            $user->setAddress($request->get('address'));

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('admin');
        }

        return $this->render('home/registration.html.twig');
    }

    #[Route('/electricity', name: 'electricity')]
    public function electricity(): Response
    {
        return $this->render('home/electrical.html.twig');
    }

    #[Route('/', name: 'home')]
    public function review(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Review::class);

        $reviews = $repository->findAll();

        return $this->render('home/index.html.twig', [
            'reviews' => $reviews
        ]);
    }

    #[Route('/email', name: 'email')]
    public function sendEmail(MailerInterface $mailer, Request $request): Response
    {
        if ($request->isMethod('POST')) {
            $email = (new Email())
                ->from($request->get('email'))
                ->to('you@example.com')
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                //->priority(Email::PRIORITY_HIGH)
                ->subject($request->get('name'))
                ->text($request->get('message'));
            // ->html('<p>See Twig integration for better HTML integration!</p>');

            $mailer->send($email);
        }

        return $this->render('home/contact.html.twig');
    }

    #[Route('/add_review', name: 'add_review')]
    public function addReview(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            $review = new Review();

            $review->setName($request->get('name'));
            $review->setEmail($request->get('email'));
            $review->setReview($request->get('review'));

            if ($this->getUser()) {
                $review->setUser($this->getUser());
            }

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($review);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->redirectToRoute('home');
    }

}

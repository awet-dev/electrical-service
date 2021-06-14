<?php

namespace App\Controller;

use App\Entity\Review;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReviewController extends AbstractController
{
    #[Route('/review', name: 'review')]
    public function index(): Response
    {
        return $this->render('review/index.html.twig', [
            'controller_name' => 'ReviewController',
        ]);
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

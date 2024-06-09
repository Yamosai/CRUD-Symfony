<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\MovieFormType;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    #[Route('/', name: 'view')]
    public function view(MovieRepository $movieRepository): Response {

        $movies = $movieRepository->findAll();

        return $this->render('movie/movies.html.twig', [
            'movies' => $movies
        ]);
    }

    #[Route('/add', name: 'add')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $movie = new Movie();
        
        $form = $this->createForm(MovieFormType::class, $movie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($movie);
            $entityManager->flush();

            return $this->redirectToRoute('view');
        }

        return $this->render('movie/add.html.twig', [
            'form' => $form
        ]);
    }
}
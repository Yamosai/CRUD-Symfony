<?php

namespace App\Controller;

use App\Repository\MovieRepository;
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
}
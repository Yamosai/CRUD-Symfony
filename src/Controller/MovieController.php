<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\FilterMovieFormType;
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
    public function view(MovieRepository $movieRepository, Request $request): Response {

        $movies = $movieRepository->findAll();

        $form = $this->createForm(FilterMovieFormType::class);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $movies = $movieRepository->filterMovie(
                $form->get('name')->getData(),
            );
        }

        return $this->render('movie/movies.html.twig', [
            'movies' => $movies,
            'form' => $form
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

     #[Route('/update/{id}', name: 'update')]
    public function update(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
        $movie = $entityManager->getRepository( Movie::class)->find($id);
        
        $form = $this->createForm(MovieFormType::class, $movie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($movie);
            $entityManager->flush();

            return $this->redirectToRoute('view');
        }

        return $this->render('movie/update.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/view/{id}', name: 'viewSolo')]
    public function viewsSolo(EntityManagerInterface $entityManager, int $id): Response
    {
        $movie = $entityManager->getRepository(Movie::class)->findOneBy(['id' => $id]);

        return $this->render('movie/movie.html.twig', [
            'movie' => $movie,
        ]);
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete(EntityManagerInterface $entityManager, int $id): Response
    {
        $movie = $entityManager->getRepository(Movie::class)->findOneBy(['id' => $id]);

        $entityManager->remove($movie);
        $entityManager->flush();

        return $this->redirectToRoute('view');
    }

    
}
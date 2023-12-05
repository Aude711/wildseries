<?php
namespace App\Controller;

use App\Entity\Actor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ActorRepository;

#[Route('/actor', name: 'actor_')]
class ActorController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(ActorRepository $actorRepository): Response
    {
        $actor = $actorRepository->findAll();
        return $this->render('actor/index.html.twig', [ 
            'actor' => $actor,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Actor $actors): Response
    {
        if (!$actors) {
            throw $this->createNotFoundException(
                'No program with id : '.$actors.' found in program\'s table.'
            );
        }
        return $this->render('actor/show.html.twig', [
            'actors' => $actors,
        ]);

    }
}
<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use App\Entity\Game;

class GamesController extends AbstractController
{
    /**
     * @Route("/", name="games")
     */
    public function gamesList(Request $request, PaginatorInterface $paginator)
    {
        $games = $this->getDoctrine()
            ->getRepository(Game::class)
            ->findBy([], ['name'=>'ASC']);

        $gamesList = $paginator->paginate(
            $games,
            $request->query->getInt('page', 1),
            20
        );

        return $this->render('games/all.html.twig', [
            'gamesList' => $gamesList
        ]);
    }

    /**
     * @Route("/game/{id}", name="game")
     */
    public function currentGame($id)
    {   
        $currentGame = $this->getDoctrine()
            -> getRepository(Game::class)
            -> find($id);
            
        return $this->render('games/current.html.twig', [
            'currentGame' => $currentGame,
        ]);
    }
}

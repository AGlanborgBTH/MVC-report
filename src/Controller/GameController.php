<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    /**
     * @Route(
     *      "/game",
     *      name="game-home",
     *      methods={"GET","HEAD"}
     * )
     */
    public function game_home(): Response
    {
        return $this->render('game/index.html.twig');
    }

    /**
     * @Route(
     *      "/game/card",
     *      name="game-card-home",
     *      methods={"GET","HEAD"}
     * )
     */
    public function card_home(): Response
    {
        return $this->render('game/card.html.twig');
    }

    /**
     * @Route(
     *      "/game/doc",
     *      name="game-doc-home",
     *      methods={"GET","HEAD"}
     * )
     */
    public function doc_home(): Response
    {
        return $this->render('game/card.html.twig');
    }
}
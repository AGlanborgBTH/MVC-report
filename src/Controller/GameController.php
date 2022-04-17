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
        return $this->render('card/game.html.twig');
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
        return $this->render('game/doc.html.twig');
    }

    /**
     * @Route(
     *      "/game/play",
     *      name="game-play-home",
     *      methods={"GET","HEAD"}
     * )
     */
    public function play_home(
        SessionInterface $session
    ): Response
    {
        if ($session->get("blackjack")) {
            $this->addFlash("game", $session->get("blackjack"));
        }

        return $this->render('game/play.html.twig');
    }

    /**
     * @Route(
     *      "/game/play",
     *      name="game-play-post",
     *      methods={"POST"}
     * )
     */
    public function play_post(
        Request $request,
        SessionInterface $session
    ): Response
    {
        $start = $request->request->get('start');
        $clear = $request->request->get('clear');

        if ($start) {
            $session->set("blackjack", new \App\Card\Game(4, new \App\Card\Deck));
        }

        if ($clear) {
            $session->clear();
        }

        return $this->redirectToRoute('game-play-home');
    }
}
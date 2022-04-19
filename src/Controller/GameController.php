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
        $hit = $request->request->get('hit');
        $stand = $request->request->get('stand');
        $continue = $request->request->get('continue');

        if ($start) {
            $amount = $request->request->get('amount');
            $session->set("blackjack", new \App\Card\BJ((int) $amount, new \App\Card\BJDeck));
        } elseif ($clear) {
            $session->clear();
        } elseif ($hit) {
            $session->get("blackjack")->hit();
        } elseif ($stand) {
            $session->get("blackjack")->stand();
        } elseif ($continue) {
            $session->get("blackjack")->continue();
        }

        return $this->redirectToRoute('game-play-home');
    }
}
<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ProjController extends AbstractController
{
    /**
     * @Route(
     *      "/proj",
     *      name="proj-home",
     *      methods={"GET","HEAD"}
     * )
     */
    public function home(): Response
    {
        return $this->render('proj/home/home.html.twig');
    }

    /**
     * @Route(
     *      "/proj",
     *      name="proj-post",
     *      methods={"POST"}
     * )
     */
    public function home_post(
        Request $request
    ): Response
    {
        $logout = $request->request->get('logout');

        if ($logout) {
            return $this->redirectToRoute('proj-home');
        }
    }

    /**
     * @Route(
     *      "/proj/about",
     *      name="proj-about-home",
     *      methods={"GET","HEAD"}
     * )
     */
    public function about(): Response
    {
        return $this->render('proj/about/content.html.twig');
    }

    /**
     * @Route(
     *      "/proj/game",
     *      name="proj-game-home",
     *      methods={"GET","HEAD"}
     * )
     */
    public function game(
        SessionInterface $session
    ): Response
    {
        if (!$session->get("poker")) {
            $session->set("poker", new \App\Poker\Poker());
        }

        $data = ["game" => $session->get("poker")];

        return $this->render('proj/game/game.html.twig', $data);
    }

    /**
     *@Route(
     *      "/proj/game",
     *      name="proj-game-post",
     *      methods={"POST"}
     * )
     */
    public function game_post(
        SessionInterface $session,
        Request $request
    ): Response
    {
        $bet = $request->request->get('commit_bet');
        $fold = $request->request->get('fold');
        $again = $request->request->get('again');
        $call = $request->request->get('call');
        $continue = $request->request->get('continue');
        $back = $request->request->get('back');
        $poker = $session->get("poker");

        if ($bet) {
            $poker->recieve_bet($request->request->get('bet'));
            $poker->flop();
        } elseif ($fold) {
            $poker->fold();
        } elseif ($again) {
            $poker->reset();
        } elseif ($call) {
            $poker->call();
            $poker->rank_player();
        } elseif ($continue) {
            $poker->rank_dealer();
            $poker->compare_ranks();
        } elseif ($back) {
            $poker->reset();
            return $this->redirectToRoute('proj-home');
        }

        return $this->redirectToRoute('proj-game-home');
    }

    /**
     * @Route(
     *      "/proj/login",
     *      name="proj-login-home",
     *      methods={"GET","HEAD"}
     * )
     */
    public function login(): Response
    {
        return $this->render('proj/user/login.html.twig');
    }

    /**
     * @Route(
     *      "/proj/register",
     *      name="proj-register-home",
     *      methods={"GET","HEAD"}
     * )
     */
    public function register(): Response
    {
        return $this->render('proj/user/register.html.twig');
    }
}
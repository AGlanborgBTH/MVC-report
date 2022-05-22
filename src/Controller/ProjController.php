<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

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
        $about = $request->request->get('about');
        $game = $request->request->get('game');
        $user = $request->request->get('user');

        if ($about) {
            return $this->redirectToRoute('proj-about-home');
        } elseif ($game) {
            return $this->redirectToRoute('proj-game-home');
        } elseif ($user) {
            return $this->redirectToRoute('proj-user-home');
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
    public function game(): Response
    {
        return $this->render('proj/game/game.html.twig');
    }

    /**
     * @Route(
     *      "/proj/user",
     *      name="proj-user-home",
     *      methods={"GET","HEAD"}
     * )
     */
    public function user(): Response
    {
        return $this->render('proj/user/user.html.twig');
    }

    /**
     * @Route(
     *      "/proj/user",
     *      name="proj-user-post",
     *      methods={"POST"}
     * )
     */
    public function user_post(
        Request $request
    ): Response
    {
        $back = $request->request->get('back');

        if ($back) {
            return $this->redirectToRoute('proj-home');
        }
    }
}
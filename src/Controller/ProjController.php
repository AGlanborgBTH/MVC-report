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

        if ($about) {
            return $this->redirectToRoute('proj-about-home');
        } elseif ($game) {
            return $this->redirectToRoute('proj-game-home');
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
}
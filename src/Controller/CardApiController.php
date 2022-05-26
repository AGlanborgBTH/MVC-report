<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CardApiController extends AbstractController
{
    /**
     * @Route(
     *      "/card/api/deck",
     *      name="api-deck",
     *      methods={"GET","HEAD"}
     * )
     */
    public function apiDeck(
        SessionInterface $session
    ): Response {
        $deck = $session->get("carddeck") ?? new \App\Card\Deck();

        $diamonds = [];
        $clubs = [];
        $hearts = [];
        $spades = [];

        foreach ($deck->ordered as $card) {
            if ($card->getPattern() == "D") {
                array_push($diamonds, $card->getValue() . $card->getPattern());
            } elseif ($card->getPattern() == "C") {
                array_push($clubs, $card->getValue() . $card->getPattern());
            } elseif ($card->getPattern() == "H") {
                array_push($hearts, $card->getValue() . $card->getPattern());
            } elseif ($card->getPattern() == "S") {
                array_push($spades, $card->getValue() . $card->getPattern());
            }
        }

        $data = [
           "diamonds" => $diamonds,
           "clubs" => $clubs,
           "hearts" => $hearts,
           "spades" => $spades
        ];

        $session->set("carddeck", $deck);

        $response = new Response();
        $response->setContent(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}

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
    public function api_deck(
        SessionInterface $session
    ): Response {
        $deck = $session->get("carddeck") ?? new \App\Card\Deck();

        $diamonds = [];
        $clubs = [];
        $hearts = [];
        $spades = [];

        foreach ($deck->ordered as $card) {
            if ($card->get_pattern() == "D") {
                array_push($diamonds, $card->get_value() . $card->get_pattern());
            } elseif ($card->get_pattern() == "C") {
                array_push($clubs, $card->get_value() . $card->get_pattern());
            } elseif ($card->get_pattern() == "H") {
                array_push($hearts, $card->get_value() . $card->get_pattern());
            } elseif ($card->get_pattern() == "S") {
                array_push($spades, $card->get_value() . $card->get_pattern());
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

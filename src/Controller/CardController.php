<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CardController extends AbstractController
{
    /**
     * @Route(
     *      "/card",
     *      name="card-home",
     *      methods={"GET","HEAD"}
     * )
     */
    public function cardHome(): Response
    {
        return $this->render('card/index.html.twig');
    }

    /**
     * @Route(
     *      "/card",
     *      name="card-home-post",
     *      methods={"POST"}
     * )
     */
    public function diceHandProcess(
        Request $request,
        SessionInterface $session
    ): Response {
        $clear = $request->request->get('clear');

        if ($clear) {
            $session->clear();
        }

        return $this->redirectToRoute('card-home');
    }

    /**
     * @Route(
     *      "/card/deck",
     *      name="card-deck-home",
     *      methods={"GET","HEAD"}
     * )
     */
    public function deckHome(
        SessionInterface $session
    ): Response {
        $deck = $session->get("carddeck") ?? new \App\Card\Deck();

        [$diamonds, $clubs, $hearts, $spades] = $this->sortDeck($deck);

        $data = [
           "diamonds" => $diamonds,
           "clubs" => $clubs,
           "hearts" => $hearts,
           "spades" => $spades
        ];

        $session->set("carddeck", $deck);

        return $this->render('card/deck.html.twig', $data);
    }

    /**
     * @Route(
     *      "/card/deck/shuffle",
     *      name="card-deck-shuffle",
     *      methods={"GET","HEAD"}
     * )
     */
    public function deckShuffle(
        SessionInterface $session
    ): Response {
        $deck = $session->get("carddeck") ?? new \App\Card\Deck();

        $deck->shuffle();

        $pile = "";

        foreach ($deck->pile as $card) {
            if ($pile == "") {
                $pile = $pile . $card->getValue() . $card->getPattern();
            } else {
                $pile = $card->getValue() . $card->getPattern() . " | " . $pile;
            }
        }

        $data = ["pile" => $pile];

        $session->set("carddeck", $deck);

        return $this->render('card/shuffle.html.twig', $data);
    }

    /**
     * @Route(
     *      "/card/deck/draw",
     *      name="card-deck-draw",
     *      methods={"GET","HEAD"}
     * )
     */
    public function deckDraw(
        SessionInterface $session
    ): Response {
        $deck = $session->get("carddeck") ?? new \App\Card\Deck();

        $card = $deck->draw();

        if (is_null($card)) {
            $this->addFlash("card", "Deck empty");
        } else {
            $this->addFlash("card", $card->getValue() . $card->getPattern());
        }

        $data = ["rem" => count($deck->pile)];

        $session->set("carddeck", $deck);

        return $this->render('card/draw.html.twig', $data);
    }

    /**
     * @Route(
     *      "/card/deck/draw/{numDraw}",
     *      name="card-deck-draw-num",
     *      methods={"GET","HEAD"}
     * )
     */
    public function deckDrawMultiple(
        int $numDraw,
        SessionInterface $session
    ): Response {
        $deck = $session->get("carddeck") ?? new \App\Card\Deck();

        if ($numDraw > 0) {
            for ($i = 0; $i < $numDraw; $i++) {
                $card = $deck->draw();

                if (is_null($card)) {
                    $this->addFlash("card", "None");
                } else {
                    $this->addFlash("card", $card->getValue() . $card->getPattern());
                }
            }
        } else {
            $this->addFlash("card", "None");
        }

        $data = ["rem" => count($deck->pile)];

        $session->set("carddeck", $deck);

        return $this->render('card/draw.html.twig', $data);
    }

    /**
     * @Route(
     *      "/card/deck/deal/{numPlayers}/{numCards}",
     *      name="card-deck-deal",
     *      methods={"GET","HEAD"}
     * )
     */
    public function deckDeal(
        int $numPlayers,
        int $numCards,
        SessionInterface $session
    ): Response {
        $deck = $session->get("carddeck") ?? new \App\Card\Deck();
        if ($numPlayers > 0 and $numCards >= 0) {
            $size = count($deck->pile);
            $temp = 0;
            $all = 0;
            if ($numCards > $size) {
                $temp = $size;
                $all = floor($size / $numPlayers);
            } else {
                $temp = $numCards;
                $all = floor($numCards / $numPlayers);
            }
            $count = $temp - $all * $numPlayers;
            if ($numCards >= $numPlayers) {
                for ($x = 0; $x < $numPlayers; $x++) {
                    $person = new \App\Card\Player();
                    if (count($deck->pile) > 0) {
                        for ($y = 0; $y < $all; $y++) {
                            $person->addCard($deck->draw());
                        }
                    }
                    if ($count > 0 and count($deck->pile) > 0) {
                        $person->addCard($deck->draw());
                        $count--;
                    }
                    $this->addFlash("person", $person);
                }
            } else {
                for ($x = 0; $x < $numPlayers; $x++) {
                    $person = new \App\Card\Player();
                    if ($count > 0 and count($deck->pile) > 0) {
                        $person->addCard($deck->draw());
                        $count--;
                    }
                    $this->addFlash("person", $person);
                }
            }
        }
        $data = ["rem" => count($deck->pile)];

        $session->set("carddeck", $deck);

        return $this->render('card/deal.html.twig', $data);
    }

    /**
     * @Route(
     *      "/card/deck2",
     *      name="card-deck-home-two",
     *      methods={"GET","HEAD"}
     * )
     */
    public function deckHomeTwo(
        SessionInterface $session
    ): Response {
        $deck = $session->get("carddeck2") ?? new \App\Card\DeckWith2Jokers();

        [$diamonds, $clubs, $hearts, $spades, $remaining] = $this->sortDeck($deck);

        $data = [
            "diamonds" => $diamonds,
            "clubs" => $clubs,
            "hearts" => $hearts,
            "spades" => $spades,
            "remaining" => $remaining
        ];

        $session->set("carddeck2", $deck);

        return $this->render('card/deck.html.twig', $data);
    }

    private function sortDeck($deck)
    {
        $diamonds = "";
        $clubs = "";
        $hearts = "";
        $spades = "";
        $remaining = "";

        foreach ($deck->ordered as $card) {
            if ($card->getPattern() == "D") {
                $diamonds = $diamonds . $card->getValue() . $card->getPattern() . " | ";
            } elseif ($card->getPattern() == "C") {
                $clubs = $clubs . $card->getValue() . $card->getPattern() . " | ";
            } elseif ($card->getPattern() == "H") {
                $hearts = $hearts . $card->getValue() . $card->getPattern() . " | ";
            } elseif ($card->getPattern() == "S") {
                $spades = $spades . $card->getValue() . $card->getPattern() . " | ";
            } else {
                $remaining = $remaining . $card->getValue() . $card->getPattern() . " | ";
            }
        }

        return [$diamonds, $clubs, $hearts, $spades, $remaining];
    }
}

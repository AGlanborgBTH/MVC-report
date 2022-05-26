<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Logins;
use App\Entity\History;
use App\Repository\LoginsRepository;
use App\Repository\HistoryRepository;

class ProjController extends AbstractController
{
    /**
     * @Route(
     *      "/proj",
     *      name="proj-home",
     *      methods={"GET","HEAD"}
     * )
     */
    public function home(
        SessionInterface $session,
        LoginsRepository $loginsRepository
    ): Response {
        $data = [];

        if ($session->get("pokerUser")) {
            $account = $loginsRepository->find(
                $session->get("pokerUser")
            );

            if ($account->isAdmin()) {
                $data = [
                        "admin" => "true",
                        "account" => $account->getUserName()
                ];
            } else {
                $data = ["account" => $account->getUserName()];
            }
        }

        return $this->render('proj/home/home.html.twig', $data);
    }

    /**
     * @Route(
     *      "/proj",
     *      name="proj-post",
     *      methods={"POST"}
     * )
     */
    public function homePost(
        SessionInterface $session,
        Request $request
    ): Response {
        $logout = $request->request->get('logout');

        if ($logout) {
            $session->clear();
        }

        return $this->redirectToRoute('proj-home');
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
        SessionInterface $session,
        LoginsRepository $loginsRepository
    ): Response {
        if (!$session->get("poker")) {
            $session->set("poker", new \App\Poker\Poker());
        }

        if ($session->get("pokerUser")) {
            $account = $loginsRepository->find(
                $session->get("pokerUser")
            );

            $data = [
                "game" => $session->get("poker"),
                "account" => $account->getMoney()
            ];
        } else {
            $data = ["game" => $session->get("poker")];
        }



        return $this->render('proj/game/game.html.twig', $data);
    }

    /**
     *@Route(
     *      "/proj/game",
     *      name="proj-game-post",
     *      methods={"POST"}
     * )
     */
    public function gamePost(
        ManagerRegistry $doctrine,
        SessionInterface $session,
        LoginsRepository $loginsRepository,
        Request $request
    ): Response {
        $bet = $request->request->get('commit_bet');
        $fold = $request->request->get('fold');
        $again = $request->request->get('again');
        $call = $request->request->get('call');
        $continue = $request->request->get('continue');
        $back = $request->request->get('back');
        $poker = $session->get("poker");

        if ($bet) {
            $money = $request->request->get('bet');
            $poker->recieveBet($money);

            $entityManager = $doctrine->getManager();

            $account = $loginsRepository->find($session->get("pokerUser"));
            $account->setMoney($account->getMoney() - $money);

            $entityManager->flush();

            $history = new History();

            $history->setLoginId($request->request->get("pokerUser"));
            $history->setActs(
                "Account-name: " .
                $account->getUserName() .
                ", has BET " .
                $money . " money on poker"
            );

            $entityManager->persist($history);
            $entityManager->flush();

            $poker->flop();
        } elseif ($fold) {
            $entityManager = $doctrine->getManager();

            $account = $loginsRepository->find($session->get("pokerUser"));
            $account->setMoney($account->getMoney() - $poker->bet);

            $history = new History();

            $money = $poker->bet;

            $history->setLoginId($request->request->get("pokerUser"));
            $history->setActs(
                "Account-name: " .
                $account->getUserName() .
                ", has FOLDED and lost " .
                $money .
                " money on poker "
            );

            $entityManager->persist($history);
            $entityManager->flush();

            $poker->fold();
        } elseif ($again) {
            $poker->reset();
        } elseif ($call) {
            $entityManager = $doctrine->getManager();

            $account = $loginsRepository->find($session->get("pokerUser"));
            $account->setMoney($account->getMoney() - $poker->bet);

            $history = new History();

            $money = $poker->bet;

            $history->setLoginId($request->request->get("pokerUser"));
            $history->setActs(
                "Account-name: " .
                $account->getUserName() .
                ", has CALLED and bet another " .
                $money .
                " money on poker | " .
                $money * 2 .
                " money in total"
            );

            $entityManager->persist($history);
            $entityManager->flush();

            $poker->call();
            $poker->rankPlayer();
        } elseif ($continue) {
            $poker->rankDealer();
            $poker->compareRanks();

            if ($poker->phase == 4) {
                $entityManager = $doctrine->getManager();

                $account = $loginsRepository->find($session->get("pokerUser"));

                $history = new History();
                $money = $poker->bet;

                $history->setLoginId($request->request->get("pokerUser"));
                $history->setActs(
                    "Account-name: " .
                    $account->getUserName() .
                    ", LOST in poker and lost a total of " .
                    $money .
                    " money"
                );

                $entityManager->persist($history);

                $entityManager->flush();
            } elseif ($poker->phase == 5) {
                $entityManager = $doctrine->getManager();

                $money = $poker->bet;

                $account = $loginsRepository->find($session->get("pokerUser"));
                $account->setMoney($account->getMoney() + $money);

                $history = new History();

                $history->setLoginId($request->request->get("pokerUser"));
                $history->setActs(
                    "Account-name: " .
                    $account->getUserName() .
                    ", DREW in poker and recieved " .
                    $money .
                    " money back to thier wallet"
                );

                $entityManager->persist($history);

                $entityManager->flush();
            } elseif ($poker->phase == 6) {
                $entityManager = $doctrine->getManager();

                $money = $poker->bet * 2;

                $account = $loginsRepository->find($session->get("pokerUser"));
                $account->setMoney($account->getMoney() + ($money));

                $history = new History();

                $history->setLoginId($request->request->get("pokerUser"));
                $history->setActs(
                    "Account-name: " .
                    $account->getUserName() .
                    ", WON in poker and recieved " .
                    $money .
                    " money back to thier wallet"
                );

                $entityManager->persist($history);

                $entityManager->flush();
            }
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
     *@Route(
     *      "/proj/login",
     *      name="proj-login-post",
     *      methods={"POST"}
     * )
     */
    public function loginPost(
        SessionInterface $session,
        LoginsRepository $loginsRepository,
        Request $request
    ): Response {
        $login = $request->request->get('login');
        $account_name = $request->request->get('account_name');
        $password = $request->request->get('password');

        if ($login) {
            $account = $loginsRepository->findOneBy(
                ["user_name" => $account_name]
            );

            if ($account->getPassword() == $password) {
                $session->set("pokerUser", $account->getId());

                return $this->redirectToRoute('proj-home');
            }
        }

        $data = ["fail" => "Failed to login"];

        return $this->redirectToRoute('proj-login-home', $data);
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

    /**
     *@Route(
     *      "/proj/register",
     *      name="proj-register-post",
     *      methods={"POST"}
     * )
     */
    public function registerPost(
        ManagerRegistry $doctrine,
        Request $request
    ): Response {
        $register = $request->request->get('register');
        $account_name = $request->request->get('account_name');
        $password = $request->request->get('password');

        if ($register) {
            $entityManager = $doctrine->getManager();

            $login = new Logins();

            $login->setUserName($account_name);
            $login->setPassword($password);
            $login->setMoney(1000);
            $login->setAdmin(false);

            $entityManager->persist($login);
            $entityManager->flush();

            $data = ["fail" => "Account created"];

            return $this->redirectToRoute('proj-login-home', $data);
        }

        $data = ["fail" => "Account failed to creat"];

        return $this->redirectToRoute('proj-register-home', $data);
    }

    /**
     * @Route(
     *      "/proj/reset",
     *      name="proj-reset-home",
     *      methods={"GET","HEAD"}
     * )
     */
    public function reset(
        ManagerRegistry $doctrine,
        SessionInterface $session,
        LoginsRepository $loginsRepository,
        HistoryRepository $historyRepository
    ): Response {
        $session->clear();

        $data = [
            "login" => $loginsRepository->findAll(),
            "history" => $historyRepository->findAll()
        ];

        $entityManager = $doctrine->getManager();

        foreach ($data["login"] as $login) {
            $entityManager->remove($login);
        }

        foreach ($data["history"] as $history) {
            $entityManager->remove($history);
        }

        $entityManager->flush();

        $login = new Logins();

        $login->setUserName("doe");
        $login->setPassword("doe");
        $login->setMoney(1000);
        $login->setAdmin(false);

        $entityManager->persist($login);

        $login = new Logins();

        $login->setUserName("admin");
        $login->setPassword("admin");
        $login->setMoney(1000000);
        $login->setAdmin(true);

        $entityManager->persist($login);

        $entityManager->flush();

        return $this->redirectToRoute('proj-home');
    }

    /**
     * @Route(
     *      "/proj/history",
     *      name="proj-history-home",
     *      methods={"GET","HEAD"}
     * )
     */
    public function history(
        HistoryRepository $historyRepository
    ): Response {
        $data = [
            "history" => $historyRepository->findAll()
        ];

        return $this->render('proj/about/history.html.twig', $data);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Character;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\CharacterRepository;

class LibraryController extends AbstractController
{
    /**
     * @Route(
     *      "/library",
     *      name="library-home",
     *      methods={"GET","HEAD"}
     * )
     */
    public function libraryHome(
        CharacterRepository $characterRepository
    ): Response {
        $data = [
            "character" => $characterRepository->findAll()
        ];

        return $this->render('library/index.html.twig', $data);
    }

    /**
     * @Route(
     *      "/library/create",
     *      name="library-create-home",
     *      methods={"GET","HEAD"}
     * )
     */
    public function createHome(): Response
    {
        return $this->render('library/create.html.twig');
    }

    /**
     * @Route(
     *      "/library/create",
     *      name="library-create-post",
     *      methods={"POST"}
     * )
     */
    public function createPost(
        ManagerRegistry $doctrine,
        Request $request
    ): Response {
        $submit = $request->request->get('submit');

        if ($submit) {
            $entityManager = $doctrine->getManager();

            $name = $request->request->get('name');
            $race = $request->request->get('race');
            $gender = $request->request->get('gender');
            $img = $request->request->get('img');

            $character = new Character();

            if ($name and $race and $gender) {
                strtolower($img);
                str_replace(" ", "_", $img);

                $character->setName($name);
                $character->setRace($race);
                $character->setGender($gender);

                $character = $this->imgSetup($character, $img);
            }
            $entityManager->persist($character);
            $entityManager->flush();
        }

        return $this->redirectToRoute('library-home');
    }

    /**
     * @Route(
     *      "/library/show/{id}",
     *      name="library-show-home",
     *      methods={"GET","HEAD"}
     * )
     */
    public function showHome(
        CharacterRepository $characterRepository,
        int $id
    ): Response {
        $data = [
            "character" => $characterRepository->find($id)
        ];

        return $this->render('library/show.html.twig', $data);
    }

    /**
     * @Route(
     *      "/library/update/{id}",
     *      name="library-update-home",
     *      methods={"GET","HEAD"}
     * )
     */
    public function updateHome(
        CharacterRepository $characterRepository,
        int $id
    ): Response {
        $data = [
            "character" => $characterRepository->find($id)
        ];

        return $this->render('library/update.html.twig', $data);
    }

    /**
     * @Route(
     *      "/library/update/{id}",
     *      name="library-update-post",
     *      methods={"POST"}
     * )
     */
    public function updatePost(
        ManagerRegistry $doctrine,
        Request $request,
        int $id
    ): Response {
        $submit = $request->request->get('submit');

        if ($submit) {
            $entityManager = $doctrine->getManager();
            $character = $entityManager->getRepository(Character::class)->find($id);

            if ($character) {
                $name = $request->request->get('name');
                $race = $request->request->get('race');
                $gender = $request->request->get('gender');
                $img = $request->request->get('img');

                if ($name and $race and $gender) {
                    $character->setName($name);
                    $character->setRace($race);
                    $character->setGender($gender);

                    $character = $this->imgSetup($character, $img);
                }

                $entityManager->flush();
            }
        }

        return $this->redirectToRoute('library-home');
    }

    /**
     * @Route(
     *      "/library/delete/{id}",
     *      name="library-delete-home",
     *      methods={"GET","HEAD"}
     * )
     */
    public function deleteHome(
        CharacterRepository $characterRepository,
        int $id
    ): Response {
        $data = [
            "character" => $characterRepository->find($id)
        ];

        return $this->render('library/delete.html.twig', $data);
    }

    /**
     * @Route(
     *      "/library/delete/{id}",
     *      name="library-delete-post",
     *      methods={"POST"}
     * )
     */
    public function deletePost(
        ManagerRegistry $doctrine,
        Request $request,
        int $id
    ): Response {
        $submit = $request->request->get('submit');

        if ($submit) {
            $entityManager = $doctrine->getManager();
            $character = $entityManager->getRepository(Character::class)->find($id);

            if ($character) {
                $entityManager->remove($character);
                $entityManager->flush();
            }
        }

        return $this->redirectToRoute('library-home');
    }

    private function imgSetup($character, $img)
    {
        if ($img) {
            $img = strtolower($img);
            $img = str_replace(" ", "_", $img);

            $possibleImg = [
                "fane",
                "ifan_ben-mezd",
                "lohse",
                "marcus_miles",
                "beast",
                "red_prince",
                "sebille"
            ];

            if (in_array($img, $possibleImg)) {
                if ($img == "beast") {
                    $img = "marcus_miles";
                }

                $character->setImg($img);
            } else {
                $character->setImg("mask_of_the_shapeshifter");
            }
        } else {
            $character->setImg("mask_of_the_shapeshifter");
        }

        return $character;
    }
}

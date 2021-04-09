<?php

namespace App\Controller\client;

use App\Repository\ChestRepository;
use App\Repository\RessourceRepository;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    /**
     * @Route("/client/shop", name="client_shop")
     * @param RessourceRepository $ressourceRepository
     * @param TagRepository $tagRepository
     * @return Response
     */
    public function shop(RessourceRepository $ressourceRepository, TagRepository $tagRepository): Response
    {
        $allRessources = $ressourceRepository->findAll();
        $tags = $tagRepository->findAll();


        return $this->render('client/shop.html.twig', [
            'controller_name' => 'ClientController',
            'allRessources' => $allRessources,
            'tags' => $tags
        ]);
    }

    /**
     * @Route("/client/shop/buy/{id}", name="buy_this_items")
     * @param $id
     * @param RessourceRepository $ressourceRepository

     * @param EntityManagerInterface $entityManager
     */
    public function buyOneItems($id, RessourceRepository $ressourceRepository, EntityManagerInterface $entityManager)
    {
        $user = $this->getUser();

        $chestToUpdate = $user->getChest();
        $itemToBuy = $ressourceRepository->find($id);

        if ($itemToBuy) {

            if ($itemToBuy->getPrice() <= $user->getCoins()) {
                $chestToUpdate->addRessource($itemToBuy);
                $user->setCoins($user->getCoins() - $itemToBuy->getPrice());
                $entityManager->persist($chestToUpdate);
                $entityManager->flush();
            }else{
                $this->addFlash('warning','Crédits insuffisants');
                $this->redirectToRoute('client_shop');
            }

            $this->addFlash('success','Achat effectué');
        }
    }

    /**
     * @Route("/client/my-chest", name="client_chest")
     */
    public function myChest(): Response
    {
        return $this->render('client/my-chest.html.twig', [
            'controller_name' => 'ClientController',
        ]);
    }
}

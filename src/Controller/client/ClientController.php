<?php

namespace App\Controller\client;


use App\Repository\DocumentCategoryRepository;
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
     * @param DocumentCategoryRepository $categoryRepository
     * @return Response
     */
    public function shop(RessourceRepository $ressourceRepository, TagRepository $tagRepository, DocumentCategoryRepository $categoryRepository): Response
    {
        $user = $this->getUser();
        $allRessources = $ressourceRepository->findAll();
        $tags = $tagRepository->findAll();
        $allCategory = $categoryRepository->findAll();
        $userRessources = $user->getLibrary();

        return $this->render('client/shop.html.twig', [
            'controller_name' => 'ClientController',
            'allRessources' => $allRessources,
            'allCategory' => $allCategory,
            'userRessources' => $userRessources,
            'tags' => $tags
        ]);
    }

    /**
     * @Route("/client/shop/buy/{id}", name="buy_this_items")
     * @param $id
     * @param RessourceRepository $ressourceRepository
     * @param EntityManagerInterface $entityManager
     */
    public function buyOneItems($id, RessourceRepository $ressourceRepository,  EntityManagerInterface $entityManager)
    {
        $user = $this->getUser();

        $itemToBuy = $ressourceRepository->find($id);

        foreach ($user->getLibrary() as $library)   {
            if ($library ==  $itemToBuy){
                $this->addFlash('warning','Cet item est déja dans votre bibliothèque');
                return $this->redirectToRoute('client_shop');
            }
        }

        if ($itemToBuy) {
            if ($itemToBuy->getPrice() <= $user->getCoins()) {
                $user->setCoins($user->getCoins() - $itemToBuy->getPrice());
                $user->addLibrary($itemToBuy);
                $entityManager->flush();
            }else{
                $this->addFlash('warning','Crédits insuffisants');
                return $this->redirectToRoute('client_shop');
            }
            $this->addFlash('success','Achat effectué');
        }
        return $this->redirectToRoute('client_chest');
    }

    /**
     * @Route("/client/my-chest", name="client_chest")
     * @param DocumentCategoryRepository $categoryRepository
     * @return Response
     */
    public function myChest(DocumentCategoryRepository $categoryRepository): Response
    {
        $user = $this->getUser();

        $userRessources = $user->getLibrary();
        $allCategory = $categoryRepository->findAll();

        return $this->render('client/my-chest.html.twig', [
            'controller_name' => 'ClientController',
            'userRessources' => $userRessources,
            'allCategory' => $allCategory,
        ]);
    }
}

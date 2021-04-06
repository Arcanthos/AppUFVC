<?php

namespace App\Controller\client;

use App\Repository\RessourceRepository;
use App\Repository\TagRepository;
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
            'tags'=>$tags
        ]);
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

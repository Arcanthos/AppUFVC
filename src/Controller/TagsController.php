<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Entity\TagCategory;
use App\Form\TagsFamillyType;
use App\Form\TagType;
use App\Repository\TagCategoryRepository;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TagsController extends AbstractController
{
    /**
     * @Route("admin/tags", name="tags_manager")
     * @param Request $request
     * @param TagRepository $tagRepository
     * @param TagCategoryRepository $tagCategoryRepository
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function index(Request $request, TagRepository $tagRepository, TagCategoryRepository $tagCategoryRepository, EntityManagerInterface $entityManager): Response
    {
        $allTags = $tagRepository->findAll();
        $allCategoryTags = $tagCategoryRepository->findAll();
        $tag = new Tag();
        $tagCategory = new TagCategory();
        $newTagForm = $this->createForm(TagType::class, $tag);
        $newCategoryTagForm = $this->createForm(TagsFamillyType::class, $tagCategory);

        $newTagForm->handleRequest($request);
        $newCategoryTagForm->handleRequest($request);

        if($newCategoryTagForm->isSubmitted() && $newCategoryTagForm->isValid()){
            $entityManager->persist($tagCategory);
            $entityManager->flush();

            $this->redirectToRoute('tags_manager');
        }

        if($newTagForm->isSubmitted() && $newTagForm->isValid()){
            $entityManager->persist($tag);
            $entityManager->flush();

            $this->redirectToRoute('tags_manager');
        }


        return $this->render('tags/index.html.twig', [
            'controller_name' => 'TagsController',
            'tags'=>$allTags,
            'tagsCategory'=>$allCategoryTags,
            'newTagForm'=>$newTagForm->createView(),
            'newCategoryTagForm'=>$newCategoryTagForm->createView()
        ]);
    }
}

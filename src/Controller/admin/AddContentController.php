<?php

namespace App\Controller\admin;

use App\Entity\Ressource;
use App\Form\RessourceType;
use App\Repository\TagCategoryRepository;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class AddContentController extends AbstractController
{
    /**
     * @Route("/admin/new-content", name="add_new_content")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param SluggerInterface $slugger
     * @param TagRepository $tagRepository
     * @param TagCategoryRepository $tagCategoryRepository
     * @return Response
     */
    public function index(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger, TagRepository $tagRepository, TagCategoryRepository $tagCategoryRepository): Response
    {
        $tagList = $tagRepository->findAll();
        $tagCategoryList = $tagCategoryRepository->findAll();
        $ressource = new Ressource();
        $form = $this->createForm(RessourceType::class, $ressource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cover = $form->get('cover')->getData();
            $file = $form->get('file')->getData();
            $tags = $form->get('tags')->getData();

            $allTags= explode(",", $tags);
            $ressource->setTags($allTags);
            $ressource->setCreateAt(new \DateTime());

            if ($cover) {
                $originalCoverName = pathinfo($cover->getClientOriginalName(), PATHINFO_FILENAME);
                $safeCoverName = $slugger->slug($originalCoverName);
                $newCoverName = $safeCoverName . '-' . uniqid() . '.' . $cover->guessExtension();

                try {
                    $cover->move(
                        $this->getParameter('cover_directory'),
                        $newCoverName
                    );
                } catch (FileException $exception) {
                    //TODO gestion erreur
                }
                $ressource->setCoverPath($newCoverName);
            }

            if ($file) {
                $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFileName = $slugger->slug($originalFileName);
                $newFileName = $safeFileName . '-' . uniqid() . '.' . $file->guessExtension();

                try {
                    $file->move(
                        $this->getParameter('ressource_directory'),
                        $newFileName
                    );
                } catch (FileException $exception) {
                    //TODO gestion erreur
                }
                $ressource->setFilePath($newFileName);
            }



            $entityManager->persist($ressource);
            $entityManager->flush();

        }


        return $this->render('add_content/newRessource.html.twig', [
            'controller_name' => 'AddContentController',
            'newRessourceForm' => $form->createView(),
            'tagList' => $tagList,
            'tagCategoryList'=>$tagCategoryList
        ]);
    }
}

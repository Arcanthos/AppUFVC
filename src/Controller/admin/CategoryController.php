<?php

namespace App\Controller\admin;


use App\Entity\DocumentCategory;
use App\Form\CategoryType;
use App\Repository\DocumentCategoryRepository;
use App\Repository\DocumentSubCategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("admin/category-manager", name="category_manager")
     * @param DocumentCategoryRepository $categoryRepository
     * @param DocumentSubCategoryRepository $subCategoryRepository
     * @return Response
     */
    public function index(DocumentCategoryRepository $categoryRepository, DocumentSubCategoryRepository $subCategoryRepository): Response
    {
        $allCategory = $categoryRepository->findAll();
        $allSubCategory = $subCategoryRepository->findAll();

        $newCategory = new DocumentCategory();
        $newCategoryForm = $this->createForm(CategoryType::class, $newCategory);

        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
            'allCategory'=> $allCategory,
            'allSubCategory'=> $allSubCategory,
            'newCategoryForm'=> $newCategoryForm->createView()
        ]);
    }

    /**
     * @Route("admin/category-manager/new", name="add_new_category")
     * @param Request $request
     * @param DocumentCategoryRepository $categoryRepository
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function addCategory(Request $request, DocumentCategoryRepository $categoryRepository, EntityManagerInterface $entityManager) : Response
    {

        if ($request->isXmlHttpRequest()){
            $data = $request->getContent();
            $data = json_decode($data, true);

            $allCategory = $categoryRepository->findAll();
            foreach ($allCategory as $category){
                if ($category->getName() === $data){
                    return $this->json(['code' => 200, 'message'=>'cette catégorie existe déja'], 200);
                }
            }
            $newCategory = new DocumentCategory();
            $newCategory->setName($data);
            $entityManager->persist($newCategory);
            $entityManager->flush();

        }

        return $this->json(['code' => 200, 'message'=>'Ca marche'], 200);


    }


}

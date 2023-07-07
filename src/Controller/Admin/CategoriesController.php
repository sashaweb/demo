<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Form\AdminCategoryFormType;
use App\Service\CategoryService;
use App\Repository\CategoryRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoriesController extends AbstractController
{

    #[Route('/secret/categories', name: 'app_admin_categories')]
    public function index(CategoryService $categoryService, CategoryRepository $categoryRepository): Response
    {
        $allCategories = $categoryRepository->findAll(); 
        $categoryService->setChildrenForAllCategories($allCategories);
        $categories = $categoryService->getRootCategories($allCategories);

        return $this->render('admin/categories/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/secret/categories/create', name: 'app_admin_categories_create')]
    public function create(EntityManagerInterface $entityManager, Request $request): Response
    {
        $category = new Category();
        $form = $this->createForm(AdminCategoryFormType::class, $category);
        $form->remove('save');

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($category);
            $entityManager->flush();
            return $this->redirectToRoute('app_admin_categories');
        }

        return $this->render('admin/categories/create.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/secret/categories/edit/{id}', name: 'app_admin_categories_edit')]
    public function update(EntityManagerInterface $entityManager, Request $request, int $id): Response
    {
        $category = $entityManager->getRepository(Category::class)->find($id);
        $form = $this->createForm(AdminCategoryFormType::class, $category);
        $form->remove('create');

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('app_admin_categories');
        }

        return $this->render('admin/categories/edit.html.twig', [
            'form' => $form,
        ]);
    }
}
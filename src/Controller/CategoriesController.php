<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\SiteRepository;
use App\Repository\CategoryRepository;
use App\Service\CategoryService;

use Doctrine\ORM\Tools\Pagination\Paginator;
use App\Helper\Pagination;

class CategoriesController extends AbstractController
{
    #[Route('/categories/{slug}', name: 'app_categories')]
    public function categories(string $slug, 
        Request $request,
        SiteRepository $siteRepository,
        CategoryRepository $categoryRepository, 
        CategoryService $categoryService
        ): Response
    {
        $category = $categoryRepository->findOneByAlias($slug);
        $allCategories = $categoryRepository->findAll();
        $categoryService->setChildrenForCategory($allCategories, $category);

        $page = max(1, $request->query->getInt('page', 1));
        $paginator = $siteRepository->getPaginatorByCategory($category->getId(), $page);

        $navParams = Pagination::getNavigationParams(count($paginator), $page, SiteRepository::PAGINATOR_PER_PAGE, 4);

        return $this->render('categories/index.html.twig', [
            'category' => $category,
            'sites' => $paginator,
            'nav_params' => $navParams,
        ]);
    }
}

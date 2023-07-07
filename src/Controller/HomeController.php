<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\CategoryRepository;
use App\Repository\SiteRepository;
use App\Service\CategoryService;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        CategoryService $categoryService, 
        CategoryRepository $categoryRepository,
        SiteRepository $siteRepository
        ): Response
    {
        $allCategories = $categoryRepository->findAll(); 
        $categoryService->setChildrenForAllCategories($allCategories);

        $counters = $categoryRepository->getSiteCounters();
        $categoryService->setCounters($allCategories, $counters);

        $categories = $categoryService->getRootCategories($allCategories);
        $sites = $siteRepository->findNewSites();

        usort($categories, fn($a, $b) => $a->getOrderNumber() > $b->getOrderNumber());
        
        return $this->render('home/index.html.twig', [
            'categories' => $categories,
            'sites' => $sites,
        ]);
    }
}

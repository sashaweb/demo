<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\SiteRepository;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'app_search')]
    public function search(Request $request, SiteRepository $siteRepository): Response
    {
        $term = $request->query->get('term', '');
        $sites = $term ? $siteRepository->findByTerm($term) : null;
                
        return $this->render('search/index.html.twig', [
            'term' => $term,
            'sites' => $sites            
        ]);
    }
}

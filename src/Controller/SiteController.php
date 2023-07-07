<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Site;
use App\Repository\SiteRepository;

class SiteController extends AbstractController
{
    #[Route('/site/{domain}', name: 'app_site')]
    public function index(
        string $domain,
        SiteRepository $siteRepository,
        ): Response
    {      
        $site = $siteRepository->findOneByDomain($domain);

        return $this->render('site/index.html.twig', [
            'site' => $site,
        ]);
    }
}

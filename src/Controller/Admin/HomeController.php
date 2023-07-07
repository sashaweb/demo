<?php

namespace App\Controller\Admin;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\Criteria;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Site;
use App\Repository\SiteRepository;
use App\Helper\Pagination;

use App\Form\AdminHomeDeleteExpiredRequestsFormType;

class HomeController extends AbstractController
{
    #[Route('/secret', name: 'app_admin_home')]
    public function index(SiteRepository $siteRepository, Request $request): Response
    {
        $page = max(1, $request->query->getInt('page', 1));

        $term = $request->query->get('term', '');
        $all = $request->query->all();
        $statuses = isset($all['statuses']) ? $all['statuses'] : [];

        $paginator = $siteRepository->getPaginatorByCriteria($page, $term, $statuses);
        $navParams = Pagination::getNavigationParams(count($paginator), $page, SiteRepository::PAGINATOR_PER_PAGE, 4);

        $formDeleteExpiredRequests = $this->createForm(AdminHomeDeleteExpiredRequestsFormType::class);
        $formDeleteExpiredRequests->handleRequest($request);
        if ($formDeleteExpiredRequests->isSubmitted() && $formDeleteExpiredRequests->get('delete')->isClicked()) {
            $siteRepository->deleteExpiredRequests();
            return $this->redirectToRoute('app_admin_home');
        }

        $expiredRequestCount = $siteRepository->getExpiredRequestCount();
        
        return $this->render('admin/home/index.html.twig', [
            'sites' => $paginator,
            'statuses' => $statuses,
            'term' => $term,
            'nav_params' => $navParams,
            'form_delete_expired_requests' => $formDeleteExpiredRequests,
            'expired_request_count' => $expiredRequestCount,
        ]);
    }
}
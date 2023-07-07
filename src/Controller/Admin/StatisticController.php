<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Service\StatisticService;

class StatisticController extends AbstractController
{
    #[Route('/secret/statistic', name: 'app_admin_statistic')]
    public function index(StatisticService $statisticService): Response
    {       
        return $this->render('admin/statistic/index.html.twig', [
            'statistic' => $statisticService->getMonthStatistic(),
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Site;
use App\Enum\Status;
use App\Repository\SiteRepository;

class ConfirmationController extends AbstractController
{
    #[Route('/confirmation/{code}', name: 'app_confirmation')]
    public function index(
        string $code,
        Request $request,
        SiteRepository $siteRepository
    ): Response
    {
        $site = $siteRepository->findOneByConfirmationCode($code);

        if ($site && $site->getConfirmationCode()) {
            $isConfirmed = false;
            $site->setConfirmationCode(null);
            $site->setStatus(Status::PendingModeration);
            $siteRepository->save($site, true);
        } else {
            $isConfirmed = true;
        }

        return $this->render('confirmation/index.html.twig', [
            'is_confirmed' => $isConfirmed,
            'site'=> $site 
        ]);
    }
}

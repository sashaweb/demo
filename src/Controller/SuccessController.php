<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SuccessController extends AbstractController
{
    #[Route('/success', name: 'app_success')]
    public function index(): Response
    {
        $response = new Response();
        $seconds = 30;
        $response->headers->set('Refresh', $seconds.'; url=/');
        return $this->render('success/index.html.twig', [], $response);
    }
}

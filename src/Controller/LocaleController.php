<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\Routing\Annotation\Route;

class LocaleController extends AbstractController
{
    #[Route('/locale/{locale}', name: 'app_locale')]
    public function locale(Request $request, $locale): Response
    {
        $cookie = Cookie::create('_locale')->withValue($locale)->withSecure(true);
        $response = $this->redirect($request->server->get('HTTP_REFERER'));
        $response->headers->setCookie($cookie);

        return $response;
    }
}

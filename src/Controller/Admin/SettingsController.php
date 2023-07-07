<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Service\SitemapService;

class SettingsController extends AbstractController
{
    #[Route('/secret/settings', name: 'app_admin_settings')]
    public function index(Request $request, SitemapService $sitemapService): Response
    {    

        $sitemapForm = $this->createFormBuilder()
        ->add('generate', SubmitType::class)
        ->add('delete', SubmitType::class)
        ->getForm();

        $sitemap = $sitemapService->getInfo();

        $sitemapForm->handleRequest($request);
        if ($sitemapForm->isSubmitted() && $sitemapForm->isValid()) {

            if ($sitemapForm->get('generate')->isClicked()) {

                $sitemapService->generate();

                return $this->redirectToRoute('app_admin_settings');
            }

            if ($sitemapForm->get('delete')->isClicked()) {

                $sitemapService->delete();

                return $this->redirectToRoute('app_admin_settings');
            }

        }
        

        return $this->render('admin/settings/index.html.twig', [
            'sitemap_form' => $sitemapForm,
            'sitemap' => $sitemap,
        ]);
    }



}

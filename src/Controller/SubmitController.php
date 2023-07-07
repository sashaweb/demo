<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;
use Symfony\Contracts\Translation\TranslatorInterface;

use App\Entity\Site;
use App\Enum\Status;
use App\Form\SiteFormType;
use App\Repository\SiteRepository;
use App\Repository\CategoryRepository;
use App\Service\CategoryService;
use App\Service\EmailService;

class SubmitController extends AbstractController
{
    #[Route('/submit', name: 'app_submit')]
    public function submit(Request $request,
        SiteRepository $siteRepository,
        CategoryRepository $categoryRepository, 
        CategoryService $categoryService,
        EmailService $emailService,
        TranslatorInterface $translator,
        ): Response
    {      
        $site = new Site();
        $form = $this->createForm(SiteFormType::class, $site);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $site = $form->getData();
            $site->setStatus(Status::EmailNotConfirmed);
            $site->setIp($request->getClientIp());
            $site->setConfirmationCode(Uuid::v7());
            $site->setCreatedAt(new \DateTime());
            $category = $categoryRepository->find($site->getCategoryId());           
            $allCategories = $categoryRepository->findAll();
            $parentCategories = $categoryService->getParentCategories($allCategories, $category);
            $site->addCategory($category);
            foreach($parentCategories as $parentCategory) {
                $site->addCategory($parentCategory);
            }            
            $siteRepository->save($site, true);

            $emailService->sendConfirmationCode($site->getEmail(), $site->getDomain(), $site->getConfirmationCode());
            $emailService->sendAdminNewRequest($site->getDomain());

            return $this->redirectToRoute('app_success');
        }

        return $this->render('submit/index.html.twig', [
            'page_title' => 'Submit',
            'form' => $form,
        ]);
    }
}

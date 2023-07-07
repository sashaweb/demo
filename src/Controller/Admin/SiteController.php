<?php

namespace App\Controller\Admin;

use App\Entity\Site;
use App\Enum\Status;
use App\Form\AdminSiteFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\CategoryRepository;
use App\Repository\SiteRepository;
use App\Service\CategoryService;
use App\Service\EmailService;

class SiteController extends AbstractController
{

    function __construct(
        private SiteRepository $siteRepository,
        private CategoryRepository $categoryRepository, 
        private CategoryService $categoryService,
        private EmailService $emailService,
        private EntityManagerInterface $entityManager) 
    {
        
    }

    #[Route('/secret/site/{domain}', name: 'app_admin_site')]
    public function index(EntityManagerInterface $entityManager, Request $request, string $domain): Response
    {
        $site = $entityManager->getRepository(Site::class)->findOneByDomain($domain);
        $form = $this->createForm(AdminSiteFormType::class, $site);

        if ($site->getStatus() == Status::PendingPayment ||  $site->getStatus() == Status::Added) {
            $form->remove('invoice');
        }

        if ($site->getStatus() == Status::Added) {
            $form->remove('add');
        }

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            if ($form->get('delete')->isClicked()) {
                $entityManager->remove($site);
                $entityManager->flush();
                return $this->redirectToRoute('app_admin_home');
            }

            if ($form->has('invoice') && $form->get('invoice')->isClicked()) {
                if ($site->getStatus() != Status::Added && $site->getStatus() != Status::PendingPayment) {
                    $site->setStatus(Status::PendingPayment);                 
                    $this->siteRepository->save($site, true);
                    $this->emailService->sendInvoice($site->getEmail(), $site->getDomain());
                }
                return $this->redirectToRoute('app_admin_site', [
                    'domain' => $site->getDomain()
                ]);
            }

            if ($form->get('add')->isClicked()) {

                if ($site->getStatus() != Status::Added) {
                    $site->setStatus(Status::Added);                 
                    $this->siteRepository->save($site, true);
                    $this->emailService->sendAdded($site->getEmail(), $site->getDomain());
                }

                return $this->redirectToRoute('app_admin_site', [
                    'domain' => $site->getDomain()
                ]);
            }

            if ($form->get('save')->isClicked()) {

                $category = $this->categoryRepository->find($site->getCategoryId());           
                $allCategories = $this->categoryRepository->findAll();

                // Get new categories
                $newCategories = $this->categoryService->getParentCategories($allCategories, $category);
                $newCategories[] = $category;

                // Remove all categories
                foreach($site->getCategories() as $currentCategory) {
                    $site->removeCategory($currentCategory);
                }

                // Add new categories
                foreach($newCategories as $newCategory) {
                    $site->addCategory($newCategory);
                }
                
                $this->siteRepository->save($site, true);   
    
                return $this->redirectToRoute('app_admin_site', [
                    'domain' => $site->getDomain()
                ]);
            }
        }

        return $this->render('admin/site/index.html.twig', [
            'page_title' => $site->getDomain() . ' | Admin',
            'form' => $form,
            'site' => $site,
        ]);
    }

}
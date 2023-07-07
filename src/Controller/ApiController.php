<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Site;
use App\Repository\SiteRepository;
use App\Repository\CategoryRepository;
use App\Service\CategoryService;
use App\Service\EmailService;

class ApiController extends AbstractController
{

    function __construct(
        private SiteRepository $siteRepository,
        private CategoryRepository $categoryRepository, 
        private CategoryService $categoryService,
        private EntityManagerInterface $entityManager) 
    {       
    }


    #[Route('/api/categories/options/{id}')]
    public function index(CategoryRepository $categoryRepository, Request $request, CategoryService $categoryService, int $id): JsonResponse
    {

        $allCategories = $categoryRepository->findAll();
        $result = $categoryService->createOptions($allCategories, $id, $id);

        $result = array_reverse($result);
        
        return new JsonResponse($result);
    }



    #[Route('/api/sites/seed/{count}')]
    public function sitesSeed(int $count): Response
    {

        $sites = $this->siteRepository->findByConfirmationCode('seed');

        foreach($sites as $site)
        {
            $this->siteRepository->remove($site, true);
        }

        for($i = 1; $i <= $count; $i++)
        {
            $site = new Site();
            $site->setName('Name-' . $i);
            $site->setDomain('domain-' . $i .'.com');
            $site->setEmail('info@domain-' . $i .'.com');
            $site->setCategoryId(11);
            $site->setDescription('Description-' . $i);
            $site->setStatus(1);
            $site->setIp('seed');
            $site->setConfirmationCode('seed');
            $site->setCreatedAt(new \DateTime());

            $category = $this->categoryRepository->find(11);           
            $allCategories = $this->categoryRepository->findAll();
            $parentCategories = $this->categoryService->getParentCategories($allCategories, $category);
            $site->addCategory($category);
            foreach($parentCategories as $parentCategory) {
                $site->addCategory($parentCategory);
            } 

            $this->siteRepository->save($site, true);

        }
        
        return new Response('Ok! <a href="/">Home page</a>');
    }


    #[Route('/email')]
    public function sendEmail(EmailService $emailService): JsonResponse
    {
        //$emailService->sendConfirmationCode('sashaon@gmail.com', 'some-domain.com.ua', '3e23e-23e23e-jyui-r434r34r'); 
        //$emailService->sendInvoice('sashaon@gmail.com', 'some-domain.com.ua'); 
        //$emailService->sendAdded('sashaon@gmail.com', 'some-domain.com.ua');
       
        return new JsonResponse([]);
    }

}

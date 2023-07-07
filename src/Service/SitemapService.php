<?php

namespace App\Service;


use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\RequestStack;

use App\Repository\CategoryRepository;
use App\Repository\SiteRepository;
use App\Enum\Status;


class SitemapService
{
    private Filesystem $filesystem;
    private const SITEMAP_FILENAME = 'sitemap.xml';
    private $baseUrl;

    public function __construct(
        private RequestStack $requestStack,
        private CategoryRepository $categoryRepository,
        private SiteRepository $siteRepository,
    ) 
    {
        $this->filesystem = new Filesystem();
        $this->baseUrl = 'https://' . $this->requestStack->getCurrentRequest()->getHost();
    }

    public function generate()
    {
        $this->filesystem->remove(self::SITEMAP_FILENAME);
        $this->filesystem->appendToFile(self::SITEMAP_FILENAME, '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL);
        $this->filesystem->appendToFile(self::SITEMAP_FILENAME, '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL);
        $this->appendCategories();
        $this->appendSites();
        $this->filesystem->appendToFile(self::SITEMAP_FILENAME, '</urlset>');
    }

    public function delete()
    {
        $this->filesystem->remove(self::SITEMAP_FILENAME);
    }

    public function getInfo()
    {
        if(file_exists(self::SITEMAP_FILENAME)) {
            return [
                'link' => self::SITEMAP_FILENAME,
                'modified_at' => filemtime(self::SITEMAP_FILENAME),
            ];
        }

        return [
            'link' => null,
            'modified_at' => null,
        ];
    }

    private function appendCategories()
    {
        $categories = $this->categoryRepository->findAll();
        foreach($categories as $category) {
            $this->filesystem->appendToFile(self::SITEMAP_FILENAME, '<url><loc>' . $this->baseUrl . '/categories/' . $category->getAlias() . '</loc></url>' . PHP_EOL);
        }
    }

    private function appendSites()
    {
        $sites = $this->siteRepository->findByStatus(Status::Added);

        foreach($sites as $site) {
            $this->filesystem->appendToFile(self::SITEMAP_FILENAME, '<url><loc>' . $this->baseUrl . '/site/'  . urlencode($site->getDomain()) . '</loc></url>' . PHP_EOL);
        }
    }
}
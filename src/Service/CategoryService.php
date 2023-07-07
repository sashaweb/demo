<?php

namespace App\Service;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;

class CategoryService
{   
    private string $locale;
    function __construct(private RequestStack $requestStack) 
    {
        $this->locale = $this->requestStack->getCurrentRequest()->getLocale();
    }

    private function getChildren(array $allCategories, Category $category)
    {
        $result = [];
        foreach ($allCategories as $item) {
            if($item->getParentId() == $category->getId()) 
            {
                $result[] = $item;
            }
        }

        return $result;
    }


    public function setChildrenForCategory(array $allCategories, Category $category)
    {
        $category->setChildren($this->getChildren($allCategories, $category));
    }


    public function setChildrenForAllCategories(array $allCategories)
    {
        foreach ($allCategories as $category) {
            $category->setChildren($this->getChildren($allCategories, $category));
        }        
    }

    public function getRootCategories(array $allCategories)
    {
        $result = [];
        foreach ($allCategories as $category) {
            if($category->getParentId() === 0) 
            {
                $result[] = $category;
            }
        }
        return $result;
    }

    public function getParentCategories(array &$allCategories, Category $category, &$result = [])
    {
        if ($category->getParentId() != 0) {
            foreach ($allCategories as $item) {
                if($item->getId() === $category->getParentId()) 
                {
                    $this->getParentCategories($allCategories, $item, $result);
                    $result[] = $item;
                    break;
                }
            }
        }
        return $result;
    }

    //////////////////////////////////////////////////

    public function createOptions(array &$allCategories, int $categoryId, int $value, &$result = [])
    {       

        $categories = $this->getChildrenById($allCategories, $categoryId);

        if ($categories) {
            $select = [
                'value' => $value,
                'options' => [] 
            ];
            $select['options'][] = (object)[
                'id' => $categoryId,
                'name' => '',
            ];
            foreach ($categories as $item) {
                $select['options'][] = (object)[
                    'id' => $item->getId(),
                    'name' => $item->getName($this->locale),
                ];
            }
            $result[] = $select;
        }

        $parentCategoryId = $this->getParentCategoryId($allCategories, $categoryId);
        if (!is_null($parentCategoryId)) {
            $this->createOptions($allCategories, $parentCategoryId, $categoryId, $result);
        } 
        
        return $result;
    }

    public function getParentCategoryId(&$allCategories, $categoryId)
    {
        foreach ($allCategories as $category) {
            if($category->getId() === $categoryId) {
                return $category->getParentId();
            }
        }
        return null;
    }

    private function getChildrenById(array $allCategories, int $categoryId)
    {
        $result = [];
        foreach ($allCategories as $category) {
            if($category->getParentId() == $categoryId) 
            {
                $result[] = $category;
            }
        }

        return $result;
    }


    public function setCounters(array $allCategories, array $counters)
    {
        foreach($allCategories as $category)
        {
            if(isset($counters[$category->getId()]))
            {
                $category->setCount($counters[$category->getId()]);
            }
            else
            {
                $category->setCount(0);
            }
        }

    }

}
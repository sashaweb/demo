<?php

namespace App\Helper;

class Pagination 
{

    public static function getNavigationParams(int $itemsTotal,  int $currentPage, int $itemsPerPage, int $navRadius)
    {
        $numPages = ceil($itemsTotal / $itemsPerPage);
        $navRange = 2 * $navRadius + 1;

        $result = [
            'display' => true,
            'total' => $itemsTotal,
            'num_pages' => $numPages,
            'current_page' => $currentPage,
            'per_page' => $itemsPerPage,
            'start' => null,
            'end' => null,
            'first' => false,
            'last' => false, 
        ];

        if ($itemsTotal <= $itemsPerPage || $numPages < $currentPage) {
            $result['display'] = false;
            return $result;
        }

        if ($numPages <= $navRange) {
            $result['start'] = 1;
            $result['end'] = $numPages;
        }
        else if($currentPage <= $navRadius + 1) {
            $result['start'] = 1;
            $result['end'] = $navRange;
            $result['last'] = true;
        }
        else if($numPages - $currentPage <= $navRadius) {
            $result['first'] = true;
            $result['start'] = $numPages - $navRange + 1;
            $result['end'] = $numPages;
        } 
        else
        {
            $result['first'] = true;
            $result['start'] = $currentPage - $navRadius;
            $result['end'] = $currentPage + $navRadius;
            $result['last'] = true;
        }

        return $result;

    }

}
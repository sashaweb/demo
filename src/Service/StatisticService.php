<?php

namespace App\Service;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class StatisticService
{
    public function __construct(private EntityManagerInterface $entityManager)
    {}

    public function getMonthStatistic()
    {
        $conn = $this->entityManager->getConnection();
        $sql = '
            SELECT
                YEAR(`created_at`) AS `year`,
                MONTH(`created_at`) AS `month`,
                count(*) AS `count`
            FROM 
                `site`
            WHERE
                `status` = 4   
            GROUP BY YEAR(`created_at`), MONTH(`created_at`)
            ORDER BY `year` DESC, `month` DESC
        ';
        $stmt = $conn->query($sql);
        $result = [];
        while (($row = $stmt->fetchAssociative()) !== false) {
            $result[] = $row;
        }
        return $result;
    }
}
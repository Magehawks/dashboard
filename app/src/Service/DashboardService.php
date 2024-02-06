<?php

namespace App\Service;

use App\Repository\NewsRepository;

class DashboardService
{
    public function __construct(
        protected NewsRepository $newsRepository,
    )
    {
    }

    public function collectAllNews(): mixed
    {
       return $this->newsRepository->findAll();
    }
}
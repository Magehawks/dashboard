<?php

namespace App\Service;

use App\Repository\NewsRepository;
use App\Repository\ScoreBoardRepository;

class DashboardService
{
    public function __construct(
        protected NewsRepository $newsRepository,
        protected ScoreBoardRepository $scoreBoardRepository,
    )
    {
    }

    public function collectAllNews(): mixed
    {
       return $this->newsRepository->findAll();
    }
    public function collectAllRecords(): mixed
    {
        return $this->scoreBoardRepository->findAll();
    }
}
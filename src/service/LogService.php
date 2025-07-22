<?php
namespace App\Service;

use App\Entity\Log;
use App\Repository\LogRepository;

class LogService
{
    private LogRepository $logRepository;

    public function __construct(LogRepository $logRepository)
    {
        $this->logRepository = $logRepository;
    }
}

<?php

namespace App\Controller;

use Doctrine\DBAL\Connection;
use Redis;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class HealthController extends AbstractController
{
    #[Route('/health', name: 'health_check', methods: ['GET'])]
    public function __invoke(
        Connection $connection,
        Redis $redis
    ): JsonResponse {
        return new JsonResponse([
            'app'   => 'ok',
            'db'    => $this->checkDatabase($connection),
            'redis' => $this->checkRedis($redis),
        ]);
    }

    private function checkDatabase(Connection $connection): string
    {
        try {
            $connection->executeQuery('SELECT 1')->fetchOne();
            return 'ok';
        } catch (\Throwable) {
            return 'error';
        }
    }

    private function checkRedis(Redis $redis): string
    {
        try {
            $redis->ping();
            return 'ok';
        } catch (\Throwable) {
            return 'error';
        }
    }
}


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
        $result = [
            'app'   => 'ok',
            'db'    => 'ok',
            'redis' => 'ok',
        ];

        // DB check
        try {
            $connection->executeQuery('SELECT 1')->fetchOne();
        } catch (\Throwable) {
            $result['db'] = 'error';
        }

        // Redis check
        try {
            $redis->ping();
        } catch (\Throwable) {
            $result['redis'] = 'error';
        }

        return new JsonResponse($result, 200);
    }
}

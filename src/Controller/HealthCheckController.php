<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class HealthCheckController
{
    #[Route('/health', name: 'app_healthcheck', methods: ['GET'])]
    public function health(): JsonResponse
    {
        // Vous pouvez ajouter des vérifications comme la base de données, Redis, etc.
        return new JsonResponse(['status' => 'ok'], 200);
    }
}

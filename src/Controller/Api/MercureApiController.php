<?php

declare(strict_types=1);

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Attribute\Route;

class MercureApiController extends AbstractController
{
    #[Route('/api/mercure', name: 'api_mercure')]
    public function index(Request $request, HubInterface $hub): Response
    {
        $arrayRequest = $request->toArray();
        $update = new Update(
            sprintf('https://localhost/%s', $arrayRequest['topic']),
            json_encode($arrayRequest['data'])
        );

        $hub->publish($update);

        return new JsonResponse(['status' => 'ok']);
    }
}

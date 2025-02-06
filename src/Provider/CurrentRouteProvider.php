<?php

namespace App\Provider;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;

class CurrentRouteProvider
{
    public function __construct(
        private RequestStack $requestStack,
        private RouterInterface $router
    )
    {
    }

    public function provide(): string
    {
        $currentRequest = $this->requestStack->getCurrentRequest();
        $currentRoute = $currentRequest->get('_route');

        return $this->router->generate(
            $currentRoute,
            $currentRequest->attributes->get('_route_params', []),
            UrlGeneratorInterface::ABSOLUTE_URL
        );
    }
}

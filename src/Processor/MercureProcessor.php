<?php

namespace App\Processor;

use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;

class MercureProcessor
{
    const MERCURE_BASE_URL = 'https://localhost/';

    public function __construct(
        private HubInterface $hub
    )
    {
    }

    public function process(string $topic, array $data): void
    {
        $update = new Update(
            $topic,
            json_encode($data)
        );

        $this->hub->publish($update);
    }
}

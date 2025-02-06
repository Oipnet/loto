<?php

namespace App\Mapper;

use App\Entity\PrizeNumber;

class MarkPrizeNumberMercureMapper
{
    public function map(PrizeNumber $prizeNumber): array
    {
        return [
            'action' => 'mark-number',
            'prizeNumber' => [
                'number' => $prizeNumber->getNumber(),
            ]
        ];
    }
}

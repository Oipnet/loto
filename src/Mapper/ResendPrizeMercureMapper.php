<?php

namespace App\Mapper;

use App\Entity\Prize;
use App\Entity\PrizeNumber;

class ResendPrizeMercureMapper
{
    public function map(Prize $prize): array
    {
        $numbers = $prize->getPrizeNumbers()->map(fn(PrizeNumber $prizeNumber) => $prizeNumber->getNumber())->toArray();

        return [
            'action' => 'resend-grid',
            'numbers' => $numbers,
        ];
    }
}

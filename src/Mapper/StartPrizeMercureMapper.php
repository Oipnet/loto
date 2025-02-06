<?php

namespace App\Mapper;

use App\Entity\Prize;
use App\Provider\NextPrizeProvider;

class StartPrizeMercureMapper
{
    public function __construct(
        private NextPrizeProvider $nextPrizeProvider
    )
    {
    }

    public function map(Prize $prize): array
    {
        $nextPrize = $this->nextPrizeProvider->provide($prize);

        return [
            'action' => 'start',
            'prize' => [
                'title' => $prize->getTitle(),
                'description' => $prize->getDescription(),
                'winningCondition' => $prize->getWinningConditionForHuman(),
                'nextPrize' => $nextPrize ? [
                    'title' => $nextPrize->getTitle(),
                ] : null
            ]
        ];
    }
}

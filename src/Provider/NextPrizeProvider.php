<?php

namespace App\Provider;

use App\Entity\Prize;

class NextPrizeProvider
{
    public function provide(Prize $prize): ?Prize
    {
        $prizesOfTheGame = $prize->getGame()->getSortedPrizes();
        foreach ($prizesOfTheGame as $key => $prizeOfTheGame) {
            if ($prizeOfTheGame->getId() === $prize->getId()) {
                return $prizesOfTheGame[$key + 1] ?? null;
            }
        }

        return null;
    }
}

<?php

namespace App\Enum;

enum PrizeState: string
{
    case PENDING = 'En attente';
    case PROCESSING = 'En cours';
    case FINISHED = 'Terminé';
}

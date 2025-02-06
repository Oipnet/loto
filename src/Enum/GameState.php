<?php

namespace App\Enum;

enum GameState: string
{
    case PREPARING = 'En préparation';
    case PENDING = 'En attente';
    case IN_PROGRESS = 'En cours';
    case FINISHED = 'Terminé';

    public function color(): string
    {
       return match ($this) {
            self::PREPARING => 'text-orange-200',
            self::PENDING => 'text-amber-200',
            self::IN_PROGRESS => 'text-green-200',
            self::FINISHED => 'text-red-200',
        };
    }

    public function background(): string
    {
        return match ($this) {
            self::PREPARING => 'bg-orange-50',
            self::PENDING => 'bg-amber-50',
            self::IN_PROGRESS => 'bg-green-50',
            self::FINISHED => 'bg-red-50',
        };
    }

    public function outline(): string
    {
        return match ($this) {
            self::PREPARING => 'ring-orange-600/20',
            self::PENDING => 'ring-amber-600/20',
            self::IN_PROGRESS => 'ring-green-600/20',
            self::FINISHED => 'ring-red-600/20',
        };
    }
}

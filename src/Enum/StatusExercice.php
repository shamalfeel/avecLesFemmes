<?php
namespace App\Enum;

enum StatusExercice: string {
    case ENCOURS = 'en_cours';
    case CLOTURE = 'cloture';

    public function label(): string {
        return match ($this) {
            self::ENCOURS => "En cours",
            self::CLOTURE => "Clôturé",
        };
    }
}
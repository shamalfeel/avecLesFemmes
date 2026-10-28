<?php
namespace App\Enum;
enum Periodicite: string{
    case HEBDOMADAIRE = 'hebdomadaire';
    case BIMENSUELLE = 'bimensuelle';
    case MENUELLE = 'mensuelle';
    case QUINZAINE = 'quinzaine';
}
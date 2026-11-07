<?php
namespace App\Dto;
final class GroupeSearchDto
{
    public function __construct(
        public ?string $valeur = null,
    ) {
    }
}
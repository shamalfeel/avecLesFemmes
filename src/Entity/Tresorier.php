<?php

namespace App\Entity;

use App\Repository\TresorierRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TresorierRepository::class)]
class Tresorier extends User
{
    
}

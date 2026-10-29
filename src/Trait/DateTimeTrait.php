<?php
namespace App\Trait;
use Doctrine\ORM\Mapping as ORM;

trait DateTimeTrait{
    #[ORM\Column]
    private ?\DateTimeImmutable $createAt = null; 

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updateAt = null;

      public function getCreateAt(): ?\DateTimeImmutable
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeImmutable $createAt): static
    {
        $this->createAt = $createAt;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeImmutable
    {
        return $this->updateAt;
    }

    public function setUpdateAt(?\DateTimeImmutable $updateAt): static
    {
        $this->updateAt = $updateAt;

        return $this;
    }
#[ORM\PrePersist]
    public function initDate(): void
    {
        $now = new \DateTimeImmutable(); 

        $this->createAt ??= $now; # le ?? est utilisé pour vérifier si la propriété createAt est déjà définie. Si elle est nulle, elle sera initialisée avec la valeur de $now. 
        $this->updateAt = $now;
    }

    #[ORM\PreUpdate]
    public function updateDate(): void
    {
        $this->updateAt = new \DateTimeImmutable();
    }
}
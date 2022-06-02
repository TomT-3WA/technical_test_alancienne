<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartRepository::class)]
class Cart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'boolean')]
    private $Checked_out;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isCheckedOut(): ?bool
    {
        return $this->Checked_out;
    }

    public function setCheckedOut(bool $Checked_out): self
    {
        $this->Checked_out = $Checked_out;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'float', scale: 2)]
    private $PriceDutyFree;

    #[ORM\Column(type: 'float')]
    private $TVA;

    #[ORM\Column(type: 'integer')]
    private $StockOrdered;

    #[ORM\Column(type: 'integer')]
    private $MaxStockAvailable;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Image(mimeTypes={ "image/png", "image/jpg", "image/jpeg", "image/gif" })
     * @Assert\Image(allowSquare = true)
     * @Assert\Image(minWidth = 52)
     * @Assert\Image(maxWidth = 1080)
     * @Assert\Image(minHeight = 52)
     * @Assert\Image(maxHeight = 1080)
     *
     */
    private $image;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPriceDutyFree(): ?float
    {
        return $this->PriceDutyFree;
    }

    public function setPriceDutyFree(float $PriceDutyFree): self
    {
        $this->PriceDutyFree = $PriceDutyFree;

        return $this;
    }

    public function getTVA(): ?float
    {
        return $this->TVA;
    }

    public function setTVA(float $TVA): self
    {
        $this->TVA = $TVA;

        return $this;
    }

    public function getStockOrdered(): ?int
    {
        return $this->StockOrdered;
    }

    public function setStockOrdered(int $StockOrdered): self
    {
        $this->StockOrdered = $StockOrdered;

        return $this;
    }

    public function getMaxStockAvailable(): ?int
    {
        return $this->MaxStockAvailable;
    }

    public function setMaxStockAvailable(int $MaxStockAvailable): self
    {
        $this->MaxStockAvailable = $MaxStockAvailable;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\ColorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ColorRepository::class)
 */
class Color
{
     /**
     * @var int
     *
     * @ORM\Column(name="id_color", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="color_id_color_seq", allocationSize=1, initialValue=1)
     */
    private $idColor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Product", mappedBy="idColor")
     */
    private $idProduct;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idProduct = new \Doctrine\Common\Collections\ArrayCollection();
    }
    public function getIdColor(): ?int
    {
        return $this->idColor;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }


    /**
     * @return Collection<int, Product>
     */
    public function getIdProduct(): Collection
    {
        return $this->idProduct;
    }
    public function addIdProduct(Product $idProduct): self
    {
        if (!$this->idProduct->contains($idProduct)) {
            $this->idProduct[] = $idProduct;
            $idProduct->addIdColor($this);
        }
        return $this;
    }
    public function removeIdProduct(Product $idProduct): self
    {
        if ($this->idProduct->removeElement($idProduct)) {
            $idProduct->removeIdColor($this);
        }
        return $this;
    }

}

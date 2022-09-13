<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Size
 *
 * @ORM\Table(name="size")
 * @ORM\Entity
 */
class Size
{
    /**
     * @var string
     *
     * @ORM\Column(name="id_size", type="string", length=50, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="size_id_size_seq", allocationSize=1, initialValue=1)
     */
    private $idSize;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Product", mappedBy="idSize")
     */
    private $idProduct;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idProduct = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdSize(): ?string
    {
        return $this->idSize;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
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
            $idProduct->addIdSize($this);
        }

        return $this;
    }

    public function removeIdProduct(Product $idProduct): self
    {
        if ($this->idProduct->removeElement($idProduct)) {
            $idProduct->removeIdSize($this);
        }

        return $this;
    }
}

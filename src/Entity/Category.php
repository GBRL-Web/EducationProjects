<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity
 */
class Category
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_category", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="category_id_category_seq", allocationSize=1, initialValue=1)
     */
    private $idCategory;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Product", mappedBy="idCategory")
     */
    private $idProduct;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idProduct = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdCategory(): ?int
    {
        return $this->idCategory;
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
            $idProduct->addIdCategory($this);
        }

        return $this;
    }

    public function removeIdProduct(Product $idProduct): self
    {
        if ($this->idProduct->removeElement($idProduct)) {
            $idProduct->removeIdCategory($this);
        }

        return $this;
    }
}

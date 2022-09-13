<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity
 */
class Product
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_product", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="product_id_product_seq", allocationSize=1, initialValue=1)
     */
    private $idProduct;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="tag", type="string", length=255, nullable=true)
     */
    private $tag;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Color", inversedBy="idProduct")
     * @ORM\JoinTable(name="prod_col",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_product", referencedColumnName="id_product")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_color", referencedColumnName="id_color")
     *   }
     * )
     */
    private $idColor;

    /**
     * @var string|null
     *
     * @ORM\Column(name="weight", type="decimal", precision=15, scale=2, nullable=true)
     */
    private $weight;

    /**
     * @var string|null
     *
     * @ORM\Column(name="material", type="string", length=50, nullable=true)
     */
    private $material;

    /**
     * @var string|null
     *
     * @ORM\Column(name="brand", type="string", length=50, nullable=true)
     */
    private $brand;

    /**
     * @var int|null
     *
     * @ORM\Column(name="quantity", type="integer", nullable=true)
     */
    private $quantity;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="idProduct")
     * @ORM\JoinTable(name="prod_cat",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_product", referencedColumnName="id_product")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_category", referencedColumnName="id_category")
     *   }
     * )
     */
    private $idCategory;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Orders", inversedBy="idProduct")
     * @ORM\JoinTable(name="prod_ord",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_product", referencedColumnName="id_product")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_order", referencedColumnName="id_order")
     *   }
     * )
     */
    private $idOrder;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Size", inversedBy="idProduct")
     * @ORM\JoinTable(name="prod_size",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_product", referencedColumnName="id_product")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_size", referencedColumnName="id_size")
     *   }
     * )
     */
    private $idSize;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imglink;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idCategory = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idOrder = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idSize = new \Doctrine\Common\Collections\ArrayCollection();
        $this->idColor = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdProduct(): ?int
    {
        return $this->idProduct;
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

    public function getTag(): ?string
    {
        return $this->tag;
    }

    public function setTag(?string $tag): self
    {
        $this->tag = $tag;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getWeight(): ?string
    {
        return $this->weight;
    }

    public function setWeight(?string $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getMaterial(): ?string
    {
        return $this->material;
    }

    public function setMaterial(?string $material): self
    {
        $this->material = $material;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(?string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return Collection<int, Color>
     */
    public function getIdColor(): Collection
    {
        return $this->idColor;
    }
    public function addIdColor(Color $idColor): self
    {
        if (!$this->idColor->contains($idColor)) {
            $this->idColor[] = $idColor;
        }
        return $this;
    }
    public function removeIdColor(Color $idColor): self
    {
        $this->idColor->removeElement($idColor);
        return $this;
    }



    /**
     * @return Collection<int, Category>
     */
    public function getIdCategory(): Collection
    {
        return $this->idCategory;
    }

    public function addIdCategory(Category $idCategory): self
    {
        if (!$this->idCategory->contains($idCategory)) {
            $this->idCategory[] = $idCategory;
        }

        return $this;
    }

    public function removeIdCategory(Category $idCategory): self
    {
        $this->idCategory->removeElement($idCategory);

        return $this;
    }

    /**
     * @return Collection<int, Orders>
     */
    public function getIdOrder(): Collection
    {
        return $this->idOrder;
    }

    public function addIdOrder(Orders $idOrder): self
    {
        if (!$this->idOrder->contains($idOrder)) {
            $this->idOrder[] = $idOrder;
        }

        return $this;
    }

    public function removeIdOrder(Orders $idOrder): self
    {
        $this->idOrder->removeElement($idOrder);

        return $this;
    }

    /**
     * @return Collection<int, Size>
     */
    public function getIdSize(): Collection
    {
        return $this->idSize;
    }

    public function addIdSize(Size $idSize): self
    {
        if (!$this->idSize->contains($idSize)) {
            $this->idSize[] = $idSize;
        }

        return $this;
    }

    public function removeIdSize(Size $idSize): self
    {
        $this->idSize->removeElement($idSize);

        return $this;
    }

    public function getImglink(): ?string
    {
        return $this->imglink;
    }

    public function setImglink(string $imglink): self
    {
        $this->imglink = $imglink;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }
}

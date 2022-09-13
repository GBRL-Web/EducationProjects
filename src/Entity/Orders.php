<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Orders
 *
 * @ORM\Table(name="orders", indexes={@ORM\Index(name="IDX_E52FFDEE69893C5E", columns={"id_platform"}), @ORM\Index(name="IDX_E52FFDEE675A0085", columns={"id_delivery"}), @ORM\Index(name="IDX_E52FFDEE12EB649B", columns={"id"})})
 * @ORM\Entity
 */
class Orders
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_order", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="orders_id_order_seq", allocationSize=1, initialValue=1)
     */
    private $idOrder;

    /**
     * @var string|null
     *
     * @ORM\Column(name="statut", type="string", length=50, nullable=true)
     */
    private $statut;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="invoice_date", type="date", nullable=true)
     */
    private $invoiceDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="total", type="decimal", precision=15, scale=2, nullable=true)
     */
    private $total;

    /**
     * @var string|null
     *
     * @ORM\Column(name="total_tax", type="decimal", precision=15, scale=2, nullable=true)
     */
    private $totalTax;

    /**
     * @var \PayPlatform
     *
     * @ORM\ManyToOne(targetEntity="PayPlatform")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_platform", referencedColumnName="id_platform")
     * })
     */
    private $idPlatform;

    /**
     * @var \Delivery
     *
     * @ORM\ManyToOne(targetEntity="Delivery")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_delivery", referencedColumnName="id_delivery")
     * })
     */
    private $idDelivery;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id", referencedColumnName="id_user")
     * })
     */
    private $idUser;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Product", mappedBy="idOrder")
     */
    private $idProduct;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idProduct = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdOrder(): ?int
    {
        return $this->idOrder;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(?string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getInvoiceDate(): ?\DateTimeInterface
    {
        return $this->invoiceDate;
    }

    public function setInvoiceDate(?\DateTimeInterface $invoiceDate): self
    {
        $this->invoiceDate = $invoiceDate;

        return $this;
    }

    public function getTotal(): ?string
    {
        return $this->total;
    }

    public function setTotal(?string $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getTotalTax(): ?string
    {
        return $this->totalTax;
    }

    public function setTotalTax(?string $totalTax): self
    {
        $this->totalTax = $totalTax;

        return $this;
    }

    public function getIdPlatform(): ?PayPlatform
    {
        return $this->idPlatform;
    }

    public function setIdPlatform(?PayPlatform $idPlatform): self
    {
        $this->idPlatform = $idPlatform;

        return $this;
    }

    public function getIdDelivery(): ?Delivery
    {
        return $this->idDelivery;
    }

    public function setIdDelivery(?Delivery $idDelivery): self
    {
        $this->idDelivery = $idDelivery;

        return $this;
    }

    public function getIdPerson(): ?User
    {
        return $this->idUser;
    }

    public function setIdPerson(?User $idUser): self
    {
        $this->idPerson = $idUser;

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
            $idProduct->addIdOrder($this);
        }

        return $this;
    }

    public function removeIdProduct(Product $idProduct): self
    {
        if ($this->idProduct->removeElement($idProduct)) {
            $idProduct->removeIdOrder($this);
        }

        return $this;
    }

}

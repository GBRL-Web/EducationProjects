<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Address
 *
 * @ORM\Table(name="address")
 * @ORM\Entity
 */
class Address
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_address", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="address_id_address_seq", allocationSize=1, initialValue=1)
     */
    private $idAddress;

    /**
     * @var string|null
     *
     * @ORM\Column(name="country_code", type="string", length=255, nullable=true)
     */
    private $countryCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="city", type="string",  length=255, nullable=true)
     */
    private $city;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="street", type="string",  length=255, nullable=true)
     */
    private $street;

    /**
     * @var string|null
     *
     * @ORM\Column(name="address_aux", type="string",  length=255, nullable=true)
     */
    private $addressAux;

    /**
     * @var string|null
     *
     * @ORM\Column(name="postal_code", type="string",  length=255, nullable=true)
     */
    private $postalCode;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="User", mappedBy="idAddress")
     */
    private $idUser;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idUser = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdAddress(): ?int
    {
        return $this->idAddress;
    }

    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    public function setCountryCode(?string $countryCode): self
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
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

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(?string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getAddressAux(): ?string
    {
        return $this->addressAux;
    }

    public function setAddressAux(?string $addressAux): self
    {
        $this->addressAux = $addressAux;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(?string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getIdUser(): Collection
    {
        return $this->idUser;
    }

    public function addIdUser(User $idUser): self
    {
        if (!$this->idUser->contains($idUser)) {
            $this->idUser[] = $idUser;
            $idUser->addIdAddress($this);
        }

        return $this;
    }

    public function removeIdUser(User $idUser): self
    {
        if ($this->idUser->removeElement($idUser)) {
            $idUser->removeIdAddress($this);
        }

        return $this;
    }
}

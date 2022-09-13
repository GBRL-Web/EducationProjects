<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * PayPlatform
 *
 * @ORM\Table(name="pay_platform")
 * @ORM\Entity
 */
class PayPlatform
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_platform", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="pay_platform_id_platform_seq", allocationSize=1, initialValue=1)
     */
    private $idPlatform;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=true)
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="User", mappedBy="idPlatform")
     */
    private $idUser;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idPerson = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getIdPlatform(): ?int
    {
        return $this->idPlatform;
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
     * @return Collection<int, User>
     */
    public function getIdUser(): Collection
    {
        return $this->idUser;
    }

    public function addIdPerson(User $idUser): self
    {
        if (!$this->idUser->contains($idUser)) {
            $this->idUser[] = $idUser;
            $idUser->addIdPlatform($this);
        }

        return $this;
    }

    public function removeIdUser(User $idUser): self
    {
        if ($this->idUser->removeElement($idUser)) {
            $idUser->removeIdPlatform($this);
        }

        return $this;
    }

}

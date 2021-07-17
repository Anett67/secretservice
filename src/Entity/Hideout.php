<?php

namespace App\Entity;

use App\Repository\HideoutRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=HideoutRepository::class)
 * @UniqueEntity("code", message="Une planque avec ce code existe déjà")
 * @UniqueEntity("address", message="Une planque avec cette addresse existe déjà")
 */
class Hideout
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min=6, 
     *      minMessage="Le code doit comporter au moins 6 caractères"
     * )
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min=6, 
     *      minMessage="L'addresse doit comporter au moins 6 caractères"
     * )
     */
    private $address;

    /**
     * @ORM\ManyToOne(targetEntity=Country::class, inversedBy="hideouts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $country;

    /**
     * @ORM\ManyToOne(targetEntity=HideoutType::class, inversedBy="hideouts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToMany(targetEntity=Mission::class, mappedBy="Hideout")
     */
    private $missions;

    public function __construct()
    {
        $this->missions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getType(): ?HideoutType
    {
        return $this->type;
    }

    public function setType(?HideoutType $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Mission[]
     */
    public function getMissions(): Collection
    {
        return $this->missions;
    }

    public function addMission(Mission $mission): self
    {
        if (!$this->missions->contains($mission)) {
            $this->missions[] = $mission;
            $mission->addHideout($this);
        }

        return $this;
    }

    public function removeMission(Mission $mission): self
    {
        if ($this->missions->removeElement($mission)) {
            $mission->removeHideout($this);
        }

        return $this;
    }
}

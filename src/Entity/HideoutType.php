<?php

namespace App\Entity;

use App\Repository\HideoutTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=HideoutTypeRepository::class)
 * @UniqueEntity("name", message="Un type de planque avec ce nom existe déjà")
 */
class HideoutType
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
     *      min=3, 
     *      minMessage="Le nom doit comporter au moins 3 caractères",
     *      max=100,
     *      maxMessage="Le nom peut comporter maximum 100 caractères"
     * )
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Hideout::class, mappedBy="type")
     */
    private $hideouts;

    public function __construct()
    {
        $this->hideouts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
     * @return Collection|Hideout[]
     */
    public function getHideouts(): Collection
    {
        return $this->hideouts;
    }

    public function addHideout(Hideout $hideout): self
    {
        if (!$this->hideouts->contains($hideout)) {
            $this->hideouts[] = $hideout;
            $hideout->setType($this);
        }

        return $this;
    }

    public function removeHideout(Hideout $hideout): self
    {
        if ($this->hideouts->removeElement($hideout)) {
            // set the owning side to null (unless already changed)
            if ($hideout->getType() === $this) {
                $hideout->setType(null);
            }
        }

        return $this;
    }
}

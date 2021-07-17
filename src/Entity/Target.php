<?php

namespace App\Entity;

use App\Repository\TargetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=TargetRepository::class)
 * @UniqueEntity("code_name", message="Un cible avec ce code existe déjà")
 */
class Target
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
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min=3, 
     *      minMessage="Le prénom doit comporter au moins 3 caractères",
     *      max=100,
     *      maxMessage="Le prénom peut comporter maximum 100 caractères"
     * )
     */
    private $firstname;

    /**
     * @ORM\Column(type="date")
     * @Assert\LessThanOrEqual("-18 years", message="L'agent doit être majeur")
     */
    private $date_of_birth;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min=6, 
     *      minMessage="Le code doit comporter au moins 6 caractères"
     * )
     */
    private $code_name;

    /**
     * @ORM\ManyToOne(targetEntity=Country::class, inversedBy="targets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $nationality;

    /**
     * @ORM\ManyToMany(targetEntity=Mission::class, mappedBy="Target")
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

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->date_of_birth;
    }

    public function setDateOfBirth(\DateTimeInterface $date_of_birth): self
    {
        $this->date_of_birth = $date_of_birth;

        return $this;
    }

    public function getCodeName(): ?string
    {
        return $this->code_name;
    }

    public function setCodeName(string $code_name): self
    {
        $this->code_name = $code_name;

        return $this;
    }

    public function getNationality(): ?Country
    {
        return $this->nationality;
    }

    public function setNationality(?Country $nationality): self
    {
        $this->nationality = $nationality;

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
            $mission->addTarget($this);
        }

        return $this;
    }

    public function removeMission(Mission $mission): self
    {
        if ($this->missions->removeElement($mission)) {
            $mission->removeTarget($this);
        }

        return $this;
    }
}

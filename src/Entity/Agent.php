<?php

namespace App\Entity;

use App\Repository\AgentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=AgentRepository::class)
 * @UniqueEntity("id_code", message="Un agent avec ce code existe déjà")
 */
class Agent
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
    private $id_code;

    /**
     * @ORM\ManyToOne(targetEntity=Country::class, inversedBy="agents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $nationality;

    /**
     * @ORM\ManyToMany(targetEntity=Specialty::class, inversedBy="agents")
     */
    private $specialty;

    /**
     * @ORM\ManyToMany(targetEntity=Mission::class, mappedBy="agent")
     */
    private $missions;

    private $displayInForm;

    public function __construct()
    {
        $this->specialty = new ArrayCollection();
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

    public function getIdCode(): ?string
    {
        return $this->id_code;
    }

    public function setIdCode(string $id_code): self
    {
        $this->id_code = $id_code;

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
     * @return Collection|Specialty[]
     */
    public function getSpecialty(): Collection
    {
        return $this->specialty;
    }

    public function addSpecialty(Specialty $specialty): self
    {
        if (!$this->specialty->contains($specialty)) {
            $this->specialty[] = $specialty;
        }

        return $this;
    }

    public function removeSpecialty(Specialty $specialty): self
    {
        $this->specialty->removeElement($specialty);

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
            $mission->addAgent($this);
        }

        return $this;
    }

    public function removeMission(Mission $mission): self
    {
        if ($this->missions->removeElement($mission)) {
            $mission->removeAgent($this);
        }

        return $this;
    }

    public function getSpecialtyString(){

        $specialtyString = [];

        foreach($this->specialty as $specialty){
            $specialtyString[] = $specialty->getName();
        }

        return implode(', ', $specialtyString);

    }

    public function getSpecialtyIds(){

        $specialtyIds = [];

        foreach($this->specialty as $specialty){
            $specialtyIds[] = $specialty->getId();
        }

        return $specialtyIds;

    }
}

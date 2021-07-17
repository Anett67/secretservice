<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MissionRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=MissionRepository::class)
 * @UniqueEntity("code_name", message="Une mission avec ce code existe déjà")
 */
class Mission
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
     *      min=5, 
     *      minMessage="Le titre doit comporter au moins 3 caractères",
     *      max=255,
     *      maxMessage="Le titre peut comporter maximum 255 caractères"
     * )
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(
     *      min=5, 
     *      minMessage="La description doit comporter au moins 5 caractères"
     * )
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min=6,
     *      minMessage="Le code doit comporter au moins 6 caractères"
     * )
     */
    private $code_name;

    /**
     * @ORM\ManyToOne(targetEntity=Country::class, inversedBy="missions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $country;

    /**
     * @ORM\ManyToOne(targetEntity=MissionType::class, inversedBy="missions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=MissionStatus::class, inversedBy="missions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=Specialty::class, inversedBy="missions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $specialty;

    /**
     * @ORM\ManyToMany(targetEntity=Contact::class, inversedBy="missions")
     */
    private $contact;

    /**
     * @ORM\ManyToMany(targetEntity=Target::class, inversedBy="missions")
     */
    private $target;

    /**
     * @ORM\ManyToMany(targetEntity=Hideout::class, inversedBy="missions")
     */
    private $hideout;

    /**
     * @ORM\ManyToMany(targetEntity=Agent::class, inversedBy="missions")
     */
    private $agent;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\LessThanOrEqual(propertyPath="end_date", message="La date de début ne peut pas être supérieur à la date de fin")
     */
    private $start_date;

    /**
     * @ORM\Column(type="datetime")
     */
    private $end_date;

    public function __construct()
    {
        $this->contact = new ArrayCollection();
        $this->target = new ArrayCollection();
        $this->hideout = new ArrayCollection();
        $this->agent = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getType(): ?MissionType
    {
        return $this->type;
    }

    public function setType(?MissionType $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getStatus(): ?MissionStatus
    {
        return $this->status;
    }

    public function setStatus(?MissionStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getSpecialty(): ?Specialty
    {
        return $this->specialty;
    }

    public function setSpecialty(?Specialty $specialty): self
    {
        $this->specialty = $specialty;

        return $this;
    }

    /**
     * @return Collection|Contact[]
     */
    public function getContact(): Collection
    {
        return $this->contact;
    }

    public function addContact(Contact $contact): self
    {
        if (!$this->contact->contains($contact)) {
            $this->contact[] = $contact;
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        $this->contact->removeElement($contact);

        return $this;
    }

    /**
     * @return Collection|Target[]
     */
    public function getTarget(): Collection
    {
        return $this->target;
    }

    public function addTarget(Target $target): self
    {
        if (!$this->target->contains($target)) {
            $this->target[] = $target;
        }

        return $this;
    }

    public function removeTarget(Target $target): self
    {
        $this->target->removeElement($target);

        return $this;
    }

    /**
     * @return Collection|Hideout[]
     */
    public function getHideout(): Collection
    {
        return $this->hideout;
    }

    public function addHideout(Hideout $hideout): self
    {
        if (!$this->hideout->contains($hideout)) {
            $this->hideout[] = $hideout;
        }

        return $this;
    }

    public function removeHideout(Hideout $hideout): self
    {
        $this->Hideout->removeElement($hideout);

        return $this;
    }

    /**
     * @return Collection|Agent[]
     */
    public function getAgent(): Collection
    {
        return $this->agent;
    }

    public function addAgent(Agent $agent): self
    {
        if (!$this->agent->contains($agent)) {
            $this->agent[] = $agent;
        }

        return $this;
    }

    public function removeAgent(Agent $agent): self
    {
        $this->agent->removeElement($agent);

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeInterface $start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(\DateTimeInterface $end_date): self
    {
        $this->end_date = $end_date;

        return $this;
    }

    public function check_targets_agents_nationality()
    {
        $agent_nationalities_ids = [];
        $target_nationalities_ids = [];

        foreach($this->agent as $agent){
            $agent_nationalities_ids[] = $agent->getNationality()->getId();
        }

        foreach($this->target as $target){
            $target_nationalities_ids[] = $target->getNationality()->getId();
        }

        return array_diff($agent_nationalities_ids, $target_nationalities_ids) === $agent_nationalities_ids;

    }

    public function check_contact_nationality()
    {
        foreach($this->contact as $contact){
            if($contact->getNationality()->getId() !== $this->country->getId()){
                return false;
            }
        }

        return true;
    }

    public function check_hideout_country()
    {
        foreach($this->hideout as $hideout){
            if($hideout->getCountry()->getId() !== $this->country->getId()){
                return false;
            }
        }

        return true;
    }

    public function check_agents_for_specialties()
    {
        foreach($this->agent as $agent){
            foreach($agent->getSpecialty() as $specialty){
                if($specialty->getId() === $this->specialty->getId()){
                    return true;
                }
            }
        }

        return false;
    }
}

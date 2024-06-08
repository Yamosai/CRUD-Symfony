<?php

namespace App\Entity;

use App\Repository\ProducerRepository;
use App\Entity\Interfaces\IdInterface;
use App\Entity\Traits\IdTrait;
use App\Entity\Interfaces\NameInterface;
use App\Entity\Traits\NameTrait;
use App\Entity\Interfaces\CommentaryInterface;
use App\Entity\Traits\CommentaryTrait;
use App\Entity\Interfaces\CostInterface;
use App\Entity\Traits\CostTrait;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: ProducerRepository::class)]
class Producer implements IdInterface
{
    use IdTrait;

    #[ORM\OneToMany(mappedBy: 'Producer', targetEntity: Movie::class)]
    #[ORM\Column(type: 'integer', nullable: true)]
    private ?Movie $movie = null;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?float $firstName = null;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?float $lastName = null;

    #[ORM\Column(type: Types::DATE_MUTABLE , nullable: true )]
    private ?\DateTimeInterface $dateBirthday = null;

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getDatebirthday(): ?\DateTimeInterface
    {
        return $this->dateBirthday;
    }

    public function setDateBirthday(\DateTimeInterface $dateBirthday = null): self
    {
        $this->dateBirthday = $dateBirthday;

        return $this;
    }
}
<?php

namespace App\Entity;

use App\Repository\MovieRepository;
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


#[ORM\Entity(repositoryClass: MovieRepository::class)]
class Movie implements IdInterface, NameInterface
{
    use IdTrait;
    use NameTrait;

    #[ORM\Column(type: Types::DATE_MUTABLE , nullable: true )]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?float $synopsis = null;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'Movie')]
    #[ORM\JoinColumn(nullable: false)]
    private ?float $Category = null;

    #[ORM\ManyToOne(targetEntity: Producer::class, inversedBy: 'Movie')]
    #[ORM\JoinColumn(nullable: false)]
    private ?float $Producer = null;

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date = null): self
    {
        $this->date = $date;

        return $this;
    }

     public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(string $synopsis): static
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    public function getIdCategory(): ?string
    {
        return $this->Category;
    }

    public function setIdCategory(string $Category): static
    {
        $this->Category = $Category;

        return $this;
    }

    public function getIdProducer(): ?string
    {
        return $this->Producer;
    }

    public function setIdIdProducer(string $IdProducer): static
    {
        $this->Producer = $IdProducer;

        return $this;
    }
}
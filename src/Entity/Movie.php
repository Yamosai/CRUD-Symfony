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
    private ?string $synopsis = null;

    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'movies')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Collection $categories = null;

    #[ORM\ManyToOne(targetEntity: Producer::class, inversedBy: 'movie')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Producer $producer = null;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

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
    /**
     * @return Collection<int, Category>
     */
    public function getCategories(): Collection
    {
      return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->addMovie($this); 
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        $this->categories->removeElement($category);
        $category->removeMovie($this);

        return $this;
    }

    public function getProducer(): ?Producer
    {
        return $this->producer;
    }

    public function setProducer(Producer $producer): static
    {
        $this->producer = $producer;

        return $this;
    }
}
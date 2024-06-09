<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use App\Entity\Interfaces\IdInterface;
use App\Entity\Traits\IdTrait;
use App\Entity\Interfaces\NameInterface;
use App\Entity\Traits\NameTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category implements IdInterface, NameInterface
{
    
    use IdTrait;
    use NameTrait;
    
    #[ORM\ManyToMany(mappedBy: 'categories', targetEntity: Movie::class)]
    private ?Collection $movies;      

    public function __construct()
    {
        $this->movies = new ArrayCollection();
    }

    /**
     * @return Collection<int, Movie>
     */
    public function getMovies(): Collection
    {
      return $this->movies;
    }

    public function addMovie(Movie $movies): self
    {
        if (!$this->movies->contains($movies)) {
            $this->movies[] = $movies;
        }

        return $this;
    }

    public function removeMovie(Movie $movies): self
    {
        $this->movies->removeElement($movies);

        return $this;
    }
}
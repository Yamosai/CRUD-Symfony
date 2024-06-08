<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use App\Entity\Interfaces\IdInterface;
use App\Entity\Traits\IdTrait;
use App\Entity\Interfaces\NameInterface;
use App\Entity\Traits\NameTrait;
use App\Entity\Interfaces\CommentaryInterface;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category implements IdInterface, NameInterface
{
    
    use IdTrait;
    use NameTrait;
    
    #[ORM\OneToMany(mappedBy: 'Category', targetEntity: Movie::class)]
    #[ORM\Column(type: 'integer', nullable: true)]
    private ?Movie $movie = null;      
}
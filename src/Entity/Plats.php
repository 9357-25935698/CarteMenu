<?php

namespace App\Entity;

use App\Repository\PlatsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlatsRepository::class)
 */
class Plats
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $Prix;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Image;

     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie", inversedBy="plats")
     */
    private $categorie;

 

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->Prix;
    }

    public function setPrix(?float $Prix): self
    {
        $this->Prix = $Prix;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(string $Image): self
    {
        $this->Image = $Image;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }


}

<?php

namespace App\Entity;

use App\Repository\OeuvreExposeeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OeuvreExposeeRepository::class)
 */
class OeuvreExposee
{
    // /**
    //  
    //  * @ORM\GeneratedValue
    //  * @ORM\Column(type="integer")
    //  */
    // private $id;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id_exposition;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id_oeuvre;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix;

    // public function getId(): ?int
    // {
    //     return $this->id;
    // }

    public function getIdExposition(): ?int
    {
        return $this->id_exposition;
    }

    public function setIdExposition(int $id_exposition): self
    {
        $this->id_exposition = $id_exposition;

        return $this;
    }

    public function getIdOeuvre(): ?int
    {
        return $this->id_oeuvre;
    }

    public function setIdOeuvre(int $id_oeuvre): self
    {
        $this->id_oeuvre = $id_oeuvre;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }
}

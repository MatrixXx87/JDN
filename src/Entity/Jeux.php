<?php

namespace App\Entity;
use App\Repository\JeuxRepository;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use Symfony\Component\Validator\Constraint as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=JeuxRepository::class)
 * @UniqueEntity ("title")
 */
class Jeux
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $joueursmini;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $joueursmaxi;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $timegame;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $agemini;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $contenuboite;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $regledujeu;    

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

    public function getSlug(): string
    {
        return (new Slugify())->slugify($this->title);
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

    public function getJoueursmini(): ?int
    {
        return $this->joueursmini;
    }

    public function setJoueursmini(int $joueursmini): self
    {
        $this->joueursmini = $joueursmini;

        return $this;
    }

    public function getJoueursmaxi(): ?int
    {
        return $this->joueursmaxi;
    }

    public function setJoueursmaxi(?int $joueursmaxi): self
    {
        $this->joueursmaxi = $joueursmaxi;

        return $this;
    }

    public function getTimegame(): ?int
    {
        return $this->timegame;
    }

    public function setTimegame(?int $timegame): self
    {
        $this->timegame = $timegame;

        return $this;
    }

    public function getAgemini(): ?int
    {
        return $this->agemini;
    }

    public function setAgemini(?int $agemini): self
    {
        $this->agemini = $agemini;

        return $this;
    }

    public function getContenuboite(): ?string
    {
        return $this->contenuboite;
    }

    public function setContenuboite(?string $contenuboite): self
    {
        $this->contenuboite = $contenuboite;

        return $this;
    }

    public function getRegledujeu(): ?string
    {
        return $this->regledujeu;
    }

    public function setRegledujeu(?string $regledujeu): self
    {
        $this->regledujeu = $regledujeu;

        return $this;
    }
}

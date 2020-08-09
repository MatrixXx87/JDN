<?php

namespace App\Entity;
use App\Repository\JeuxRepository;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use Symfony\Component\Validator\Constraint as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=JeuxRepository::class)
 * @UniqueEntity ("title")
 * @Vich\Uploadable()
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
     * @var string|null
     * @ORM\Column(type="string", length=255)
     */
    private $filename;

    /**
     * @var File|null
     * 
     * @Vich\UploadableField(mapping="jeux_images", fileNameProperty="filename")
     */
    private $imageFile;

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

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;    

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

       /**
     * @return null|string
     */
    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * @param null|string $filename
     * @return Jeux
     */
    public function setFilename(?string $filename): Jeux
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * @return null|File
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param null|File $imageFile
     * @return Jeux
     */
    public function setImageFile(?File $imageFile): Jeux
    {
        $this->imageFile = $imageFile;
        if ($this->imageFile instanceof UploadedFile) {
            $this->updated_at = new \DateTime('now');
        }
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }


}

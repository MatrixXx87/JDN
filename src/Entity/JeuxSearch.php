<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

class JeuxSearch {

    /**
     * @var int|null
     */
    private $maxPlayer;

    /**
     * @var int|null
     * @Assert\Range(min=10, max=400)
     */
    private $minPlayer;

    /**
     * @var ArrayCollection
     */
    private $options;

    public function __construct()
    {
        $this->options = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getMaxPlayer(): ?int
    {
        return $this->maxPlayer;
    }

    /**
     * @param int|null $maxPlayer
     * @return JeuxSearch
     */
    public function setMaxPlayer(int $maxPlayer): JeuxSearch
    {
        $this->maxPlayer = $maxPlayer;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMinPlayer(): ?int
    {
        return $this->minPlayer;
    }

    /**
     * @param int|null $minSurface
     * @return JeuxSearch
     */
    public function setMinPlayer(int $minPlayer): JeuxSearch
    {
        $this->minPlayer = $minPlayer;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getOptions(): ArrayCollection
    {
        return $this->options;
    }

    /**
     * @param ArrayCollection $options
     */
    public function setOptions(ArrayCollection $options): void
    {
        $this->options = $options;
    }

}

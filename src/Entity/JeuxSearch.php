<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

class JeuxSearch {

    /**
     * @var int|null
     * @Assert\Range(min=1, max=10)
     */
    private $Player;

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
    public function getPlayer(): ?int
    {
        return $this->Player;
    }

    /**
     * @param int|null $Player
     * @return JeuxSearch
     */
    public function setPlayer(int $Player): JeuxSearch
    {
        $this->Player = $Player;
        return $this;
    }


}

<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Team
 *
 * @ORM\Table(name="team")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TeamRepository")
 */
class Team
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=128, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="flag", type="string", length=255, unique=true)
     */
    private $flag;

    /**
     * @var AbstractGame[]
     * @ORM\ManyToOne(targetEntity="AbstractGame", inversedBy="localTeam")
     */
    private $localGames;

    /**
     * @var AbstractGame[]
     * @ORM\ManyToOne(targetEntity="AbstractGame", inversedBy="visitorTeam")
     */
    private $visitorGames;

    /**
     * @var Player[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Player", mappedBy="team")
     */
    private $players;

    /**
     * Return list of team's games
     * @return AbstractGame[]
     */
    public function getGames(): array
    {
        return array_merge(
            $this->getLocalGames(),
            $this->getVisitorGames()
        );
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Team
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set flag.
     *
     * @param string $flag
     *
     * @return Team
     */
    public function setFlag($flag)
    {
        $this->flag = $flag;

        return $this;
    }

    /**
     * Get flag.
     *
     * @return string
     */
    public function getFlag()
    {
        return $this->flag;
    }


    /**
     * Set localGames.
     *
     * @param AbstractGame[]|null $localGames
     *
     * @return Team
     */
    public function setLocalGames(array $localGames = []): self
    {
        $this->localGames = $localGames;
        return $this;
    }

    /**
     * Get localGames.
     * @return AbstractGame[]|null
     */
    public function getLocalGames(): ?array
    {
        return $this->localGames;
    }

    /**
     * Set visitorGames.
     * @param AbstractGame[]|null $visitorGames
     * @return Team
     */
    public function setVisitorGames(array $visitorGames = []): self
    {
        $this->visitorGames = $visitorGames;
        return $this;
    }

    /**
     * Get visitorGames.
     * @return AbstractGame[]|null
     */
    public function getVisitorGames(): ?array
    {
        return $this->visitorGames;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->players = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add player.
     *
     * @param \AppBundle\Entity\Player $player
     *
     * @return Team
     */
    public function addPlayer(\AppBundle\Entity\Player $player)
    {
        $this->players[] = $player;

        return $this;
    }

    /**
     * Remove player.
     *
     * @param \AppBundle\Entity\Player $player
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removePlayer(\AppBundle\Entity\Player $player)
    {
        return $this->players->removeElement($player);
    }

    /**
     * Get players.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlayers()
    {
        return $this->players;
    }
}

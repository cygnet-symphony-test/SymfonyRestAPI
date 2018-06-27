<?php

namespace AppBundle\Entity\Football;

use Doctrine\ORM\Mapping as ORM;

/**
 * Team
 *
 * @ORM\Table(name="football_team")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Football\TeamRepository")
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="strip", type="string", length=255)
     */
    private $strip; 

    /**
    *  @var int
    * @ORM\Column(name="league_id", type="integer")
     */
    private $league_id;

    /**
    *  @var int
    *
     * @ORM\ManyToOne(targetEntity="League", inversedBy="team")
     * @ORM\JoinColumn(name="league_id", referencedColumnName="id")
     */
    private $leagueId;


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
     * Get league_id.
     *
     * @return int
     */
     public function getLeagueId()
     {
        return $this->leagueId;
    }


    /**
     * Set league.
     *
     * @return int
     */
    public function setLeagueId($leagueId)
    {
        $this->leagueId =  $leagueId;
        return $this;
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
     * Set strip.
     *
     * @param string $strip
     *
     * @return Team
     */
    public function setStrip($strip)
    {
        $this->strip = $strip;

        return $this;
    }

    /**
     * Get strip.
     *
     * @return string
     */
    public function getStrip()
    {
        return $this->strip;
    }

     /**
    * Get model variables.
    */
     public function getArrayCopy(Team $team){
        return array(
            // 'id' => $team->getId(),
            'name' => $team->getName(),
            'strip' => $team->getStrip(),
        );
    }
}
<?php

namespace AppBundle\Entity\Football;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * League
 *
 * @ORM\Table(name="football_league")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Football\LeagueRepository")
 */
class League
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
     * @ORM\OneToMany(targetEntity="Team", mappedBy="league")
     */
    private $leagues;

    public function __construct()
    {
        $this->leagues = new ArrayCollection();
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
     * @return League
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
    * Get model variables.
    */
    public function getArrayCopy(League $league){
        return array(
            'id' => $league->getId(),
            'name' => $league->getName(),
        );
    }
}

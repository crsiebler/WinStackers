<?php

namespace ASU\StackBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Stacker
 *
 * @ORM\Table(name="stackers")
 * @ORM\Entity(repositoryClass="ASU\StackBundle\Repository\StackerRepository")
 */
class Stacker extends \ASU\SecurityBundle\Entity\User {

    /**
     * @var ArrayCollection<Win>
     * 
     * @ORM\OneToMany(
     *      targetEntity="ASU\StackBundle\Entity\Win",
     *      mappedBy="stacker",
     *      cascade={"ALL"},
     *      orphanRemoval=true,
     *      fetch="LAZY"
     * )
     * @ORM\OrderBy({"id" = "DESC"})
     */
    private $wins;
    
    /**
     * @var ArrayCollection<Stacker>
     * 
     * @ORM\ManyToMany(targetEntity="Stacker")
     * @ORM\JoinTable(name="friends",
     *      joinColumns={@ORM\JoinColumn(name="stacker_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="friend_stacker_id", referencedColumnName="id")}
     * )
     **/
    private $friends;
    
    /**
     * @var ArrayCollection<Team>
     * 
     * @ORM\ManyToMany(
     *      targetEntity="ASU\StackBundle\Entity\Team",
     *      mappedBy="members",
     *      fetch="LAZY"
     * )
     */
    private $teams;

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct();
        
        $this->wins = new ArrayCollection();
        $this->friends = new ArrayCollection();
        $this->teams = new ArrayCollection();
    }

    /**
     * Get wins
     * 
     * @return type
     */
    public function getWins() {
        return $this->wins;
    }

    /**
     * Set wins
     * 
     * @param ArrayCollection<Win> $wins
     * @return Stacker
     */
    public function setWins($wins) {
        $this->wins = $wins;
        
        return $this;
    }

    /**
     * Get friends
     * 
     * @return ArrayCollection<Stacker>
     */
    public function getFriends() {
        return $this->friends;
    }

    /**
     * Set friends
     * 
     * @param ArrayCollection<Stacker> $friends
     * @return Stacker
     */
    public function setFriends($friends) {
        $this->friends = $friends;
        
        return $this;
    }

    /**
     * Get teams
     * 
     * @return ArrayCollection<Team>
     */
    public function getTeams() {
        return $this->teams;
    }

    /**
     * Set teams
     * 
     * @param ArrayCollection<Team> $teams
     * @return Stacker
     */
    public function setTeams($teams) {
        $this->teams = $teams;
        
        return $this;
    }

}

<?php

namespace ASU\StackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Team
 *
 * @ORM\Table(name="teams")
 * @ORM\Entity(repositoryClass="ASU\StackBundle\Repository\TeamRepository")
 */
class Team {
    
    // Define the Genre
    const GENRE_SCHOOL = 0;
    const GENRE_WORK = 1;
    const GENRE_RELIGIOUS = 2;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=64, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_created", type="date", nullable=false)
     */
    private $dateCreated;

    /**
     * @var Stacker
     *
     * @ORM\ManyToOne(
     *      targetEntity="ASU\StackBundle\Entity\Stacker",
     *      fetch="LAZY"
     * )
     * @ORM\JoinColumn(name="creator_id", referencedColumnName="id")
     */
    private $creator;

    /**
     * @var integer
     *
     * @ORM\Column(name="genre", type="smallint", nullable=false)
     */
    private $genre;
    
    /**
     * @var ArrayCollection<Stacker>
     * 
     * @ORM\ManyToMany(
     *      targetEntity="ASU\StackBundle\Entity\Stacker",
     *      inversedBy="teams",
     *      fetch="LAZY"
     * )
     * @ORM\JoinTable(name="members")
     */
    private $members;

    /**
     * @var ArrayCollection<Win>
     * 
     * @ORM\OneToMany(
     *      targetEntity="ASU\StackBundle\Entity\Win",
     *      mappedBy="team",
     *      cascade={"ALL"},
     *      orphanRemoval=true,
     *      fetch="LAZY"
     * )
     * @ORM\OrderBy({"id" = "DESC"})
     */
    private $wins;
    
    /**
     * Constructor
     */
    public function __construct() {
        $this->wins = new ArrayCollection();
        $this->members = new ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Team
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Team
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     * @return Team
     */
    public function setDateCreated($dateCreated) {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime 
     */
    public function getDateCreated() {
        return $this->dateCreated;
    }

    /**
     * Set creator
     *
     * @param Stacker $creator
     * @return Team
     */
    public function setCreator($creator) {
        $this->creator = $creator;

        return $this;
    }

    /**
     * Get creator
     *
     * @return Stacker
     */
    public function getCreator() {
        return $this->creator;
    }

    /**
     * Set genre
     *
     * @param integer $genre
     * @return Team
     */
    public function setGenre($genre) {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return string/integer
     */
    public function getGenre($string = false) {
        if ($string) {
            switch ($this->genre) {
                case self::GENRE_SCHOOL:
                    return "School";
                case self::GENRE_WORK:
                    return "Work";
                case self::GENRE_RELIGIOUS:
                    return "Religious";
                default:
                    return strval($this->genre);
            }
        }
        return $this->genre;
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
    
}

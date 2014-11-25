<?php

namespace ASU\StackBundle\Entity;

use ASU\StackBundle\Entity\Stacker;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Win
 *
 * @ORM\Table(name="wins")
 * @ORM\Entity(repositoryClass="ASU\StackBundle\Repository\WinRepository")
 */
class Win {
    
    // Define the Win Categories
    const CATEGORY_CHORE = 0;
    const CATEGORY_DUTY = 1;
    const CATEGORY_GOAL = 2;
    const CATEGORY_MILESTONE = 3;

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
     * @ORM\Column(name="title", type="string", length=64, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="xp", type="smallint", nullable=false)
     */
    private $xp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_created", type="date", nullable=false)
     */
    private $dateCreated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_completed", type="date", nullable=true)
     */
    private $dateCompleted;

    /**
     * @var Stacker
     *
     * @ORM\ManyToOne(
     *      targetEntity="ASU\StackBundle\Entity\Stacker",
     *      inversedBy="wins",
     *      fetch="LAZY"
     * )
     */
    private $stacker;
    
    /**
     * @var Team
     *
     * @ORM\ManyToOne(
     *      targetEntity="ASU\StackBundle\Entity\Team",
     *      inversedBy="wins",
     *      fetch="LAZY"
     * )
     */
    private $team;

    /**
     * @var integer
     *
     * @ORM\Column(name="category", type="smallint")
     */
    private $category;
    
    /**
     * @var ArrayCollection<Goal>
     * 
     * @ORM\OneToMany(
     *      targetEntity="ASU\StackBundle\Entity\Goal",
     *      mappedBy="win",
     *      fetch="EAGER"
     * )
     */
    private $goals;
    
    /**
     * Constructor
     * 
     * @param Stacker $stacker
     * @param Team $team
     */
    public function __construct(Stacker $stacker = null, Team $team = null) {
        $this->team = $team;
        $this->stacker = $stacker;
        $this->dateCreated = new \DateTime('NOW'); // Set to today's date
        $this->goals = new ArrayCollection();
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
     * Set title
     *
     * @param string $title
     * @return Win
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Win
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
     * Set xp
     *
     * @param integer $xp
     * @return Win
     */
    public function setXp($xp) {
        $this->xp = $xp;

        return $this;
    }

    /**
     * Get xp
     *
     * @return integer 
     */
    public function getXp() {
        return $this->xp;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     * @return Win
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
     * Set dateCompleted
     *
     * @param \DateTime $dateCompleted
     * @return Win
     */
    public function setDateCompleted($dateCompleted) {
        $this->dateCompleted = $dateCompleted;

        return $this;
    }

    /**
     * Get dateCompleted
     *
     * @return \DateTime 
     */
    public function getDateCompleted() {
        return $this->dateCompleted;
    }

    /**
     * Set stacker
     *
     * @param Stacker $stacker
     * @return Win
     */
    public function setStacker($stacker) {
        $this->stacker = $stacker;

        return $this;
    }

    /**
     * Get stacker
     *
     * @return Stacker
     */
    public function getStacker() {
        return $this->stacker;
    }
    
    /**
     * get team
     * 
     * @return Team
     */
    function getTeam() {
        return $this->team;
    }

    /**
     * set team
     * 
     * @param Team $team
     * @return Win
     */
    function setTeam(Team $team) {
        $this->team = $team;
        
        return $this;
    }

    /**
     * Set category
     *
     * @param integer $category
     * @return Win
     */
    public function setCategory($category) {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string/integer
     */
    public function getCategory($string = false) {
        if ($string) {
            switch ($this->category) {
                case self::CATEGORY_CHORE:
                    return "Chore";
                case self::CATEGORY_DUTY:
                    return "Duty";
                case self::CATEGORY_GOAL:
                    return "Goal";
                case self::CATEGORY_MILESTONE:
                    return "Milestone";
                default:
                    return strval($this->category);
            }
        }
        return $this->category;
    }

    /**
     * Set goals
     * 
     * @return ArrayCollection<Goal>
     */
    function getGoals() {
        return $this->goals;
    }

    /**
     * set goals
     * 
     * @param ArrayCollection<Goal> $goals
     * @return Win
     */
    function setGoals($goals) {
        $this->goals = $goals;
        
        return $this;
    }

}

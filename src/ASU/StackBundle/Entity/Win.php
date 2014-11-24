<?php

namespace ASU\StackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Win
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ASU\StackBundle\Entity\WinRepository")
 */
class Win {

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
     * @ORM\Column(name="title", type="string", length=64)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="xp", type="smallint")
     */
    private $xp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreated", type="date")
     */
    private $dateCreated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCompleted", type="date")
     */
    private $dateCompleted;

    /**
     * @var Stacker
     *
     * @ORM\Column(name="stacker", type="object")
     */
    private $stacker;

    /**
     * @var Category
     *
     * @ORM\Column(name="category", type="object")
     */
    private $category;
    
    /**
     * @var ArrayList
     * 
     * @ORM\ManyToOne()
     */
    private $friends;
    
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
     * @param \stdClass $stacker
     * @return Win
     */
    public function setStacker($stacker) {
        $this->stacker = $stacker;

        return $this;
    }

    /**
     * Get stacker
     *
     * @return \stdClass 
     */
    public function getStacker() {
        return $this->stacker;
    }

    /**
     * Set category
     *
     * @param \stdClass $category
     * @return Win
     */
    public function setCategory($category) {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \stdClass 
     */
    public function getCategory() {
        return $this->category;
    }

    /**
     * Get friends
     * 
     * @return ArrayList
     */
    function getFriends() {
        return $this->friends;
    }

    /**
     * Set friends
     * 
     * @param ArrayList $friends
     */
    function setFriends(ArrayList $friends) {
        $this->friends = $friends;
        
        return $this;
    }


}

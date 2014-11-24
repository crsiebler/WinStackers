<?php

namespace ASU\StackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Team
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ASU\StackBundle\Entity\TeamRepository")
 */
class Team {

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
     * @ORM\Column(name="description", type="string", length=255)
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
     * @var Stacker
     *
     * @ORM\Column(name="creator", type="object")
     */
    private $creator;

    /**
     * @var Genre
     *
     * @ORM\Column(name="genre", type="object")
     */
    private $genre;

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
     * @return Team
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
     * Set xp
     *
     * @param integer $xp
     * @return Team
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
     * @param \stdClass $creator
     * @return Team
     */
    public function setCreator($creator) {
        $this->creator = $creator;

        return $this;
    }

    /**
     * Get creator
     *
     * @return \stdClass 
     */
    public function getCreator() {
        return $this->creator;
    }

    /**
     * Set genre
     *
     * @param \stdClass $genre
     * @return Team
     */
    public function setGenre($genre) {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return \stdClass 
     */
    public function getGenre() {
        return $this->genre;
    }

}

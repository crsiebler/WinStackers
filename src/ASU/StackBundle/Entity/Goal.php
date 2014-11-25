<?php

namespace ASU\StackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Goal
 *
 * @ORM\Table(name="goals")
 * @ORM\Entity(repositoryClass="ASU\StackBundle\Repository\GoalRepository")
 */
class Goal {

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
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(
     *      name="percent_complete",
     *      type="decimal",
     *      scale=2,
     *      precision=3,
     *      nullable=false
     * )
     */
    private $percentComplete;

    /**
     * @var Win
     *
     * @ORM\ManyToOne(
     *      targetEntity="ASU\StackBundle\Entity\Win",
     *      inversedBy="goals",
     *      fetch="EAGER"
     * )
     * @ORM\JoinColumn(name="win_id", referencedColumnName="id")
     */
    private $win;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Goal
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
     * Set percentComplete
     *
     * @param string $percentComplete
     * @return Goal
     */
    public function setPercentComplete($percentComplete) {
        $this->percentComplete = $percentComplete;

        return $this;
    }

    /**
     * Get percentComplete
     *
     * @return string 
     */
    public function getPercentComplete() {
        return $this->percentComplete;
    }

    /**
     * Set win
     *
     * @param \stdClass $win
     * @return Goal
     */
    public function setWin($win) {
        $this->win = $win;

        return $this;
    }

    /**
     * Get win
     *
     * @return \stdClass 
     */
    public function getWin() {
        return $this->win;
    }

}

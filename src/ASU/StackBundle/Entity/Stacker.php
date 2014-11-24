<?php

namespace ASU\StackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stacker
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ASU\StackBundle\Repository\StackerRepository")
 */
class Stacker extends \ASU\SecurityBundle\Entity\User {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var ArrayList<Win>
     * 
     * @ORM\OneToMany(
     *      targetEntity="ASU\StackerBundle\Entity\Win",
     *      mappedBy="stacker",
     *      cascade={"ALL"},
     *      orphanRemoval=true,
     *      fetch="LAZY"
     * )
     * @ORM\OrderBy({"id" = "DESC"})
     */
    private $wins;
    
    /**
     * @ManyToMany(targetEntity="User", mappedBy="myFriends")
     **/
    private $friendsWithMe;

    /**
     * @ManyToMany(targetEntity="User", inversedBy="friendsWithMe")
     * @JoinTable(name="friends",
     *      joinColumns={@JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@JoinColumn(name="friend_user_id", referencedColumnName="id")}
     * )
     **/
    private $myFriends;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

}

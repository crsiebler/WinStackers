<?php

namespace ASU\SecurityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Misd\PhoneNumberBundle\Validator\Constraints\PhoneNumber as AssertPhoneNumber;

/**
 * User
 *
 * @ORM\MappedSuperclass
 */
class User extends \KMJ\ToolkitBundle\Entity\User {

}

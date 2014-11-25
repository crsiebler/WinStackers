<?php

namespace ASU\StackBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ASU\StackBundle\Entity\Goal;
use ASU\StackBundle\Form\GoalType;

/**
 * Goal controller.
 *
 * @Route("/goal")
 */
class GoalController extends Controller {

    /**
     * Lists all Goal entities.
     *
     * @Route("/")
     * @Method("GET")
     * @Template()
     */
    public function listAction() {
        $em = $this->getDoctrine()->getManager();

        $goals = $em->getRepository('ASUStackBundle:Goal')->findAll();

        return array(
            'goals' => $goals,
        );
    }

}

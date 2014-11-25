<?php

namespace ASU\StackBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ASU\StackBundle\Entity\Stacker;
use ASU\StackBundle\Entity\Team;
use ASU\StackBundle\Form\TeamType;

/**
 * Team controller.
 *
 * @Route("/team")
 */
class TeamController extends Controller {

    /**
     * Lists all Team entities.
     *
     * @Route("/")
     * @Method("GET")
     * @Template()
     */
    public function listAction() {
        $em = $this->getDoctrine()->getManager();

        $teams = $em->getRepository('ASUStackBundle:Team')->findAll();

        return array(
            'teams' => $teams,
        );
    }
    
    /**
     * Lists all Team entities subscribed to the Stacker.
     * 
     * @Route("/{stacker}")
     * @Method("GET")
     * @Template("ASUStackBundle:Team:list.html.twig")
     */
    public function memberAction(Stacker $stacker) {
        $em = $this->getDoctrine()->getManager();
        
        $teams = $em->getRepository('ASUStackBundle:Team')->findAll();
        
        return array(
            'teams' => $teams,
        );
    }
    
    /**
     * @Route("/update")
     * @Template()
     */
    public function updateAction() {
        
    }

}

<?php

namespace ASU\StackBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ASU\StackBundle\Entity\Stacker;
use ASU\StackBundle\Entity\Win;
use ASU\StackBundle\Form\WinType;

/**
 * Win controller.
 *
 * @Route("/win")
 */
class WinController extends Controller {

    /**
     * Lists all Win entities.
     *
     * @Route("/{stacker}")
     * @Method("GET")
     * @Template()
     */
    public function listAction(Stacker $stacker) {
        $em = $this->getDoctrine()->getManager();

        $wins = $em->getRepository('ASUStackBundle:Win')->findByStacker($stacker);

        return array(
            'wins' => $wins,
        );
    }
    
    /**
     * @Route("/update")
     * @Template()
     */
    public function updateAction() {
        
    }

}

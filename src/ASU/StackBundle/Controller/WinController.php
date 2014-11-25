<?php

namespace ASU\StackBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
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
     * @Route("/")
     * @Method("GET")
     * @Template()
     */
    public function listAction() {
        $em = $this->getDoctrine()->getManager();

        $wins = $em->getRepository('ASUStackBundle:Win')->findAll();

        return array(
            'wins' => $wins,
        );
    }

}

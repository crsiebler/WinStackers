<?php

namespace ASU\StackBundle\Controller;

use ASU\StackBundle\Entity\Stacker;
use ASU\StackBundle\Entity\Win;
use ASU\StackBundle\Form\WinType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Win controller.
 *
 * @Route("/win")
 */
class WinController extends Controller {

    /**
     * Lists all Win entities.
     *
     * @Route("/{stacker}", requirements={"stacker": "\d+"})
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
     * Create a new Win for the user.
     * 
     * @Route("/create")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function createAction(Request $request, Win $win = null) {
        // Grab the logged in user
        $user = $this->get('security.context')->getToken()->getUser();
        
        // Check if the win is set
        if (!isset($win)) {
            // Initialize a new Win
            $win = new Win($user);
        }

        // Create the Win form & handle the request
        $form = $this->createForm(new WinType(), $win);
        $form->handleRequest($request);

        // Check to make sure the user input is valid
        if ($form->isValid()) {
            // Grab the entity manager
            $em = $this->getDoctrine()->getManager();

            // Persist the changes to the database
            $em->persist($win);
            $em->flush();

            // Display a notification
            $this->get('session')->getFlashBag()->add('success', "Win added successfully");

            // Redirect to the details page of the new Loan
            return $this->redirect($this->generateUrl('asu_stack_win_details', array('win' => $win->getId())));
        } else if (count($form->getErrors()) > 0) {
            // Errors exist on the form so display them as a flash message
            foreach ($form->getErrors() as $error) {
                $this->get('session')->getFlashBag()->add(
                        'error', str_replace("ERROR: ", "", trim($error->getMessage()))
                );
            }
        }

        return array(
            'win' => $win,
            'form' => $form->createView(),
        );
    }
    
    /**
     * Edit an existing Win.
     * 
     * @Route("/update/{win}", requirements={"win": "\d+"})
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function updateAction(Request $request, Win $win) {
        return $this->createAction($request, $win);
    }
    
    /**
     * Display the details of a Win.
     * 
     * @Route("/details/{win}", requirements={"win": "\d+"})
     * @Method("GET")
     * @Template()
     */
    public function detailsAction(Win $win) {
        return array(
            'win' => $win,
        );
    }
    
    /**
     * Complete a win.
     * 
     * @Route("/complete/{win}", requirements={"win": "\d+"})
     * @Method("GET")
     * @Template()
     */
    public function completeAction(Win $win) {
        // Grab the entity manager
        $em = $this->getDoctrine()->getManager();
            
        $win->setDateCompleted(new \DateTime('NOW'));
        
        // Persist the changes to the database
        $em->persist($win);
        $em->flush();

        // Display a notification
        $this->get('session')->getFlashBag()->add('success', "Win completed");

        // Redirect to the details page of the Win
        if ($win->getStacker() != null) {
            return $this->redirect($this->generateUrl('asu_stack_win_list', array('stacker' => $win->getStacker()->getId())));
        } else if ($win->getTeam() != null) {
            return $this->redirect($this->generateUrl('asu_stack_team_details', array('team' => $win->getTeam()->getId())));
        }
    }

}

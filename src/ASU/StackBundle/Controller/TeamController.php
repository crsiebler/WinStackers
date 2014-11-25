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
     * @Route("/{stacker}", requirements={"stacker": "\d+"})
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
     * Create a new Team.
     * 
     * @Route("/create")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function createAction(Request $request, Team $team = null) {
        // Grab the logged in user
        $user = $this->get('security.context')->getToken()->getUser();
        
        // Check if the win is set
        if (!isset($team)) {
            // Initialize a new Win
            $team = new Team($user);
        }

        // Create the Win form & handle the request
        $form = $this->createForm(new TeamType(), $team);
        $form->handleRequest($request);

        // Check to make sure the user input is valid
        if ($form->isValid()) {
            // Grab the entity manager
            $em = $this->getDoctrine()->getManager();

            // Persist the changes to the database
            $em->persist($team);
            $em->flush();

            // Display a notification
            $this->get('session')->getFlashBag()->add('success', "Team added successfully");

            // Redirect to the details page of the new Loan
            return $this->redirect($this->generateUrl('asu_stack_team_details', array('team' => $team->getId())));
        } else if (count($form->getErrors()) > 0) {
            // Errors exist on the form so display them as a flash message
            foreach ($form->getErrors() as $error) {
                $this->get('session')->getFlashBag()->add(
                        'error', str_replace("ERROR: ", "", trim($error->getMessage()))
                );
            }
        }

        return array(
            'team' => $team,
            'form' => $form->createView(),
        );
    }
    
    /**
     * Edit an existing Team.
     * 
     * @Route("/update/{team}", requirements={"team": "\d+"})
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function updateAction(Request $request, Team $team) {
        return $this->createAction($request, $team);
    }
    
    /**
     * Display the details for the Team.
     * 
     * @Route("/details/{team}", requirements={"team": "\d+"})
     * @Method("GET")
     * @Template()
     */
    public function detailsAction(Team $team) {
        return array(
            'team' => $team,
        );
    }

}

<?php

namespace ASU\StackBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ASU\StackBundle\Entity\Stacker;
use ASU\StackBundle\Entity\Team;
use ASU\StackBundle\Entity\Win;
use ASU\StackBundle\Form\TeamType;
use ASU\StackBundle\Form\WinType;

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
        // Grab the entity manager
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
        return array(
            'teams' => $stacker->getTeams(),
        );
    }
    
    /**
     * Create a new Team.
     * 
     * @Route("/create")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function createAction(Request $request, $team = null) {
        // Grab the logged in user
        $stacker = $this->get('security.context')->getToken()->getUser();
        
        // Check if the team is set
        if (!isset($team)) {
            // Initialize a new Team
            $team = new Team($stacker);
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
            
            // Add the current user to the list of members
            $team->getMembers()->add($stacker);
            $stacker->getTeams()->add($team);
            
            // Persist the changes to the database
            $em->persist($team);
            $em->persist($stacker);
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
    
    /**
     * Create a team's win.
     * 
     * @Route("/win/create/{team}", requirements={"team": "\d+"})
     * @Method({"GET", "POST"})
     * @Template("ASUStackBundle:Win:create.html.twig")
     */
    public function createWinAction(Request $request, Team $team, $win = null) {
        // Check if the win is set
        if (!isset($win)) {
            // Initialize a new Win
            $win = new Win(null, $team);
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

            // Redirect to the details page of the Team
            return $this->redirect($this->generateUrl('asu_stack_team_details', array('team' => $win->getTeam()->getId())));
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
     * Edit a team's win.
     * 
     * @Route("/win/update/{team}/{win}", requirements={"team": "\d+", "win": "\d+"})
     * @Method({"GET", "POST"})
     * @Template("ASUStackBundle:Win:update.html.twig")
     */
    public function updateWinAction(Request $request, Team $team, Win $win) {
        return $this->createWinAction($request, $team, $win);
    }
    
    /**
     * Subscribe the stacker to the team.
     * 
     * @Route("/join/{team}/{stacker}", requirements={"team": "\d+", "stacker": "\d+"})
     * @Method("GET")
     */
    public function joinAction(Team $team, Stacker $stacker) {
        // Grab the entity manager
        $em = $this->getDoctrine()->getManager();
        
        // Add the membership
        $stacker->getTeams()->add($team);
        $team->getMembers()->add($stacker);
        
        // Persist the changes to the database
        $em->persist($stacker);
        $em->persist($team);
        $em->flush();
        
        // Display a notification
        $this->get('session')->getFlashBag()->add('success', "Team subscribed");
        
        // Redirect to the details page of the new Loan
        return $this->redirect($this->generateUrl('asu_stack_team_member', array('stacker' => $stacker->getId())));
    }
    
    /**
     * Remove the stacker from the team.
     * 
     * @Route("/leave/{team}/{stacker}", requirements={"team": "\d+", "stacker": "\d+"})
     * @Method("GET")
     */
    public function leaveAction(Team $team, Stacker $stacker) {
        // Grab the entity manager
        $em = $this->getDoctrine()->getManager();
        
        // Remove the membership
        $stacker->getTeams()->removeElement($team);
        $team->getMembers()->removeElement($stacker);
        
        // Persist the changes to the database
        $em->persist($stacker);
        $em->persist($team);
        $em->flush();
        
        // Display a notification
        $this->get('session')->getFlashBag()->add('success', "Membership removed");
        
        // Redirect to the details page of the new Loan
        return $this->redirect($this->generateUrl('asu_stack_team_member', array('stacker' => $stacker->getId())));
    }

}

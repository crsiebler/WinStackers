<?php

namespace ASU\StackBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ASU\StackBundle\Entity\Stacker;
use ASU\StackBundle\Form\StackerType;

/**
 * Stacker controller.
 *
 * @Route("/stacker")
 */
class StackerController extends Controller {

    /**
     * Lists all Stacker entities.
     *
     * @Route("/")
     * @Method("GET")
     * @Template()
     */
    public function listAction() {
        $em = $this->getDoctrine()->getManager();

        $stackers = $em->getRepository('ASUStackBundle:Stacker')->findAll();

        return array(
            'stackers' => $stackers,
        );
    }
    
    /**
     * List all friends of a stacker.
     * 
     * @Route("/friends/{stacker}", requirements={"stacker": "\d+"})
     * @Method("GET")
     * @Template("ASUStackBundle:Stacker:list.html.twig")
     */
    public function friendsAction(Stacker $stacker) {
        return array(
            'stackers' => $stacker->getFriends(),
        );
    }
    
    /**
     * Display the details for the stacker.
     * 
     * @Route("/details/{stacker}", requirements={"stacker": "\d+"})
     * @Method("GET")
     * @Template()
     */
    public function detailsAction(Stacker $stacker) {
        return array(
            'stacker' => $stacker,
        );
    }
    
    /**
     * Add the stacker to friends.
     * 
     * @Route("/add/{stacker}", requirements={"stacker": "\d+"})
     * @Method("GET")
     */
    public function addFriendAction(Stacker $stacker) {
        // Grab the logged in user
        $user = $this->get('security.context')->getToken()->getUser();
        
        // Grab the entity manager
        $em = $this->getDoctrine()->getManager();
        
        // Add the friends
        $user->getFriends()->add($stacker);
        $stacker->getFriends()->add($user);
        
        // Persist the changes to the database
        $em->persist($user);
        $em->persist($stacker);
        $em->flush();
        
        // Display a notification
        $this->get('session')->getFlashBag()->add('success', "Friend added");
        
        // Redirect to the details page of the new Loan
        return $this->redirect($this->generateUrl('asu_stack_stacker_friends', array('stacker' => $stacker->getId())));
    }
    
    /**
     * Remove the stacker from the team.
     * 
     * @Route("/remove/{stacker}", requirements={"team": "\d+", "stacker": "\d+"})
     * @Method("GET")
     */
    public function removeFriendAction(Stacker $stacker) {
        // Grab the logged in user
        $user = $this->get('security.context')->getToken()->getUser();
        
        // Grab the entity manager
        $em = $this->getDoctrine()->getManager();
        
        // Remove the friendship
        $user->getFriends()->removeElement($stacker);
        $stacker->getFriends()->removeElement($user);
        
        // Persist the changes to the database
        $em->persist($user);
        $em->persist($stacker);
        $em->flush();
        
        // Display a notification
        $this->get('session')->getFlashBag()->add('success', "Friend removed");
        
        // Redirect to the details page of the new Loan
        return $this->redirect($this->generateUrl('asu_stack_stacker_friends', array('stacker' => $stacker->getId())));
    }

}

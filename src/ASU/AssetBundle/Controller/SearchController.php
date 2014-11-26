<?php

namespace ASU\AssetBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/search")
 */
class SearchController extends Controller {

    /**
     * @Route("/results")
     * @Template()
     */
    public function resultsAction(Request $request) {
        // Declare the arrays to store the search results
        $stackers = array();
        $teams = array();
        $wins = array();
        
        // Grab the Entity Manager
        $em = $this->getDoctrine()->getManager();

        // Grab the user specified search term
        $searchTerm = trim($request->get('searchTerm'));
        
        // Make sure search term is set
        if (isset($searchTerm) && strlen($searchTerm) > 0) {
            // Search the entities for the term
            $stackers = $em->getRepository('ASUStackBundle:Stacker')->search($searchTerm);
            $teams = $em->getRepository('ASUStackBundle:Team')->search($searchTerm);
            $wins = $em->getRepository('ASUStackBundle:Win')->search($searchTerm);
        } else {
            // Invalid input, display error message
            $this->get('session')->getFlashBag()->add('error', "Search term not provided");
        }
        
        return array(
            'term' => $searchTerm,
            'stackers' => $stackers,
            'teams' => $teams,
            'wins' => $wins,
        );
    }

}

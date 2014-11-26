<?php

namespace ASU\AssetBundle\Controller;

use ASU\StackBundle\Entity\Win;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction() {
        // Grab the logged in user
        $stacker = $this->get('security.context')->getToken()->getUser();
        
        // Initialize the Win Repo
        $winRepo = $this->getDoctrine()->getRepository('ASUStackBundle:Win');
        
//        // Total up the Wins for the Stacker
//        $winCount = $winRepo->getWinCount($stacker);
//        
//        // Total up the Wins for the Stacker by Category
//        $choreWinCount = $winRepo->getWinCountByCategory($stacker, Win::CATEGORY_CHORE);
//        $dutyWinCount  = $winRepo->getWinCountByCategory($stacker, Win::CATEGORY_DUTY);
//        $goalWinCount  = $winRepo->getWinCountByCategory($stacker, Win::CATEGORY_GOAL);
//        $milestoneWinCount  = $winRepo->getWinCountByCategory($stacker, Win::CATEGORY_MILESTONE);
//        
//        // Calculate the percentages
//        $chorePercent = round($choreWinCount / $winCount * 100);
//        $dutyPercent = round($dutyWinCount / $winCount * 100);
//        $goalPercent = round($goalWinCount / $winCount * 100);
//        $milestonePercent = round($milestoneWinCount / $winCount * 100);
        
        // Gather the days active for the current user
        $daysActive = abs($stacker->getDateCreated()->diff(new \DateTime('NOW'))->days);
        
        // Make sure the days is at least 1
        if ($daysActive == 0) {
            $daysActive = 1;
        }
        
        return array(
            'completedWins' => $winRepo->getCompletedWinCount($stacker),
            'incompleteWins' => $winRepo->getIncompleteWinCount($stacker),
            'earnedXP' => $winRepo->getEarnedXP($stacker),
            'unearnedXP' => $winRepo->getUnearnedXP($stacker),
//            'chorePercent' => $chorePercent,
//            'dutyPercent' => $dutyPercent,
//            'goalPercent' => $goalPercent,
//            'milestonePercent' => $milestonePercent,
            'daysActive' => $daysActive,
        );
    }

}

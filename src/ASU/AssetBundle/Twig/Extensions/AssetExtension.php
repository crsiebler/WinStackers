<?php

namespace ASU\AssetBundle\Twig\Extensions;

use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;

/**
 * @Service()
 * @Tag("twig.extension")
 */
class AssetExtension extends \Twig_Extension {

    public function getFilters() {
        return array(
            new \Twig_SimpleFilter('money', array($this, 'moneyFilter')),
            new \Twig_SimpleFilter('percent', array($this, 'percentFilter')),
        );
    }

    /**
     * moneyFilter method
     * 
     * @param type $number
     * @param type $braces
     * @param type $decimals
     * @param type $decPoint
     * @param type $thousandsSep
     * @return string formatted number to USD money
     */
    public function moneyFilter($number, $decimals = 2, $decPoint = '.', $thousandsSep = ',') {
        $money = number_format($number, $decimals, $decPoint, $thousandsSep);

        // Check if number is negative or positive
        if ($number >= 0) {
            // Append dollar sign
            $money = '$' . $money;
        } else {
            // Append dollar sign & surround in negative braces
            $money = '($' . \abs($money) . ')';
        }

        return $money;
    }

    /**
     * percentFilter method
     * 
     * @param type $number
     * @param type $fraction
     * @param type $decimals
     * @param type $decPoint
     * @param type $thousandsSep
     * @return string formatted number to percent
     */
    public function percentFilter($number, $fraction = true, $decimals = 1, $decPoint = '.', $thousandsSep = ',') {
        // Check if number is a decimal
        if ($fraction) {
            // Move decimal 2 places
            $number *= 100;
        }

        $number = number_format($number, $decimals, $decPoint, $thousandsSep);

        // Append percentage sign
        $number = $number . '%';

        return $number;
    }

    public function getName() {
        return 'asset_extension';
    }

}

<?php

/*
 * This file is part of the FacebookBot package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FacebookBot\Test\Send\Element;

use FacebookBot\Send\Elements\SummaryElement;

class SummaryElementTest extends \PHPUnit_Framework_TestCase
{

    public function testAccessors()
    {

        $summary = new SummaryElement();
        $summary->setSubtotal(10);
        $summary->setTotalCost(15);
        $summary->setTotalTax(21);
        $summary->setShippingCost(27);
        $this->assertEquals(10, $summary->getSubtotal());
        $this->assertEquals(15, $summary->getTotalCost());
        $this->assertEquals(21, $summary->getTotalTax());
        $this->assertEquals(27, $summary->getShippingCost());
    }


    public function testGetSummary()
    {
        $summary = new SummaryElement();
        $summary->setSubtotal(10);
        $summary->setTotalCost(15);
        $summary->setTotalTax(21);
        $summary->setShippingCost(27);

        $expected = [
            'total_cost'    => 15,
            'subtotal'      => 10,
            'shipping_cost' => 27,
            'total_tax'     => 21,
        ];

        $this->assertEquals($expected, $summary->getSummary());
    }

}

<?php

/*
 * This file is part of the FacebookBot package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FacebookBot\Test\Send\Element;

use FacebookBot\Send\Elements\AdjustmentElement;

class AdjustmentElementTest extends \PHPUnit_Framework_TestCase
{

    public function testAccessors()
    {
        $element = new AdjustmentElement();
        $element->setAmount('amount');
        $element->setName('name');

        $this->assertEquals('amount', $element->getAmount());
        $this->assertEquals('name', $element->getName());
    }


    public function testGetAddress()
    {
        $element = new AdjustmentElement();
        $element->setAmount('amount');
        $element->setName('name');

        $expected = [
            'name'   => 'name',
            'amount' => 'amount',
        ];

        $this->assertEquals($expected, $element->getAsjustment());

    }

}
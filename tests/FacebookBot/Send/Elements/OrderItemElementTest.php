<?php

/*
 * This file is part of the FacebookBot package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FacebookBot\Test\Send\Element;

use FacebookBot\Send\Elements\OrderItemElement;

class OrderItemElementTest extends \PHPUnit_Framework_TestCase
{

    public function testAccessors()
    {
        $element = new OrderItemElement();
        $element->setCurrency('EUR');
        $element->setImageUrl('http://image.url');
        $element->setPrice(21.5);
        $element->setQuantity(4);
        $element->setSubTitle('Subtitle');
        $element->setTitle('Title');

        $this->assertEquals('EUR', $element->getCurrency());
        $this->assertEquals('http://image.url', $element->getImageUrl());
        $this->assertEquals(21.5, $element->getPrice());
        $this->assertEquals(4, $element->getQuantity());
        $this->assertEquals('Subtitle', $element->getSubTitle());
        $this->assertEquals('Title', $element->getTitle());
    }


    public function testGetOrderItem()
    {
        $element = new OrderItemElement();
        $element->setCurrency('EUR');
        $element->setImageUrl('http://image.url');
        $element->setPrice(21.5);
        $element->setQuantity(4);
        $element->setSubTitle('Subtitle');
        $element->setTitle('Title');

        $expected = [
            'title' => 'Title',
            'price' => 21.5,
            'subtitle' => 'Subtitle',
            'quantity' => 4,
            'currency' => 'EUR',
            'image_url' => 'http://image.url',
        ];

        $this->assertEquals($expected, $element->getOrderItem());
    }



}
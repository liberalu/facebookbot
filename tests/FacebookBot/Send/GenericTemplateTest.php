<?php

/*
 * This file is part of the FacebookBot package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FacebookBot\Test\Send;

use FacebookBot\Send\GenericTemplate;
use FacebookBot\Send\Elements\ButtonElement;
use FacebookBot\Send\Elements\ItemElement;

class GenericTemplateTest extends \PHPUnit_Framework_TestCase
{


    public function testValidate()
    {
        $genericTemplate = new GenericTemplate();
        $genericTemplate->setRecipientId(123456789);
        $genericTemplate->validate();
    }

    /**
     * @expectedException RuntimeException
     */
    public function testValidateException()
    {
        $genericTemplate = new GenericTemplate();
        $genericTemplate->validate();
    }


    public function testItems()
    {
        $item = new ItemElement();
        $item->setTitle('Item title');

        $genericTemplate = new GenericTemplate();
        $genericTemplate->setItem($item);
        $items = $genericTemplate->getItems();

        $this->assertCount(1, $items);
        $this->assertInstanceOf(ItemElement::class, $items[0]);
    }


    public function testGetMessage()
    {
        $item = new ItemElement();
        $item->setTitle('Item title');

        $genericTemplate = new GenericTemplate();
        $genericTemplate->setRecipientId(123456789);
        $genericTemplate->setItem($item);


        $expected = [
            'recipient' => [
                'id' => 123456789,
            ],
            'message' => [
                'attachment' => [
                    'type' => 'template',
                    'payload' => [
                        'template_type' => 'generic',
                        'elements' =>
                            [
                                [
                                    'title' => 'Item title',
                                ],
                            ],
                    ],
                ],
            ],
        ];

        $this->assertEquals($expected, $genericTemplate->getMessage());
    }

}

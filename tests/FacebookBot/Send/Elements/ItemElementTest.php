<?php

/*
 * This file is part of the FacebookBot package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FacebookBot\Test\Send\Element;

use FacebookBot\Send\Elements\ItemElement;
use FacebookBot\Send\Elements\ButtonElement;

class ItemElementTest extends \PHPUnit_Framework_TestCase
{

    public function testTitle()
    {
        $item = new ItemElement();
        $text  = 'anytext';
        $item->setTitle($text);
        $this->assertEquals($item->getTitle(), $text);
    }


    public function testSubTitle()
    {
        $item = new ItemElement();
        $text  = 'anytext1';
        $item->setSubTitle($text);
        $this->assertEquals($item->getSubTitle(), $text);
    }


    public function testItemUrl()
    {
        $item = new ItemElement();
        $item->setItemUrl('http://anyurl.com');
        $this->assertEquals($item->getItemUrl(), 'http://anyurl.com');
    }


    public function testImageUrl()
    {
        $item = new ItemElement();
        $item->setImageUrl('http://anyurl1.com');
        $this->assertEquals($item->getImageUrl(), 'http://anyurl1.com');
    }


    public function testButton()
    {
        $item = new ItemElement();
        $button = new ButtonElement();
        $item->setButton($button);
        $buttons = $item->getButtons();
        $this->assertCount(1, $buttons);
        $this->assertInstanceOf(ButtonElement::class, $buttons[0]);
    }


    public function testGetItem()
    {
        $button = new ButtonElement();
        $button->setType('web_url');
        $button->setTitle('Button title');
        $button->setUrl('http://anyurl.com');

        $item = new ItemElement();
        $item->setTitle('Any text 1');
        $item->setSubTitle('Any text 2');
        $item->setItemUrl('http://anyurl1.com');
        $item->setImageUrl('http://anyurl2.com');
        $item->setButton($button);

        $expected = [
            'title'     => 'Any text 1',
            'item_url'  => 'http://anyurl1.com',
            'image_url' => 'http://anyurl2.com',
            'subtitle'  => 'Any text 2',
            'buttons'   =>
                [
                    [
                        'type' => 'web_url',
                        'title' => 'Button title',
                        'url' => 'http://anyurl.com',
                    ],
                ],
        ];


        $this->assertEquals($expected, $item->getItem());
    }

}

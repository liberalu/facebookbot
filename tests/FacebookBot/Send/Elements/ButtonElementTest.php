<?php

/*
 * This file is part of the FacebookBot package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FacebookBot\Test\Send\Element;

use FacebookBot\Send\Elements\ButtonElement;

class ButtonElementTest extends \PHPUnit_Framework_TestCase
{

    public function testTitle()
    {
        $button = new ButtonElement();
        $text  = 'anytext';
        $button->setTitle($text);
        $this->assertEquals($button->getTitle(), $text);
    }


    public function testType()
    {
        $button = new ButtonElement();
        $button->setType('web_url');
        $this->assertEquals($button->getType(), ButtonElement::TYPE_WEB_URL);
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testTypeException()
    {
        $button = new ButtonElement();
        $button->setType('randomtext');
    }


    public function testurl()
    {
        $button = new ButtonElement();
        $button->setUrl('http://any.com');
        $this->assertEquals($button->getUrl(), 'http://any.com');
    }


    public function testPayload()
    {
        $button = new ButtonElement();
        $button->setPayload('MY_PAYLOAD');
        $this->assertEquals($button->getPayload(), 'MY_PAYLOAD');
    }


    public function testGetButton()
    {
        $button = new ButtonElement();
        $button->setType('web_url');
        $button->setTitle('Button title');
        $button->setUrl('http://anyurl.com');

        $expected = [
            'type'  => 'web_url',
            'url'   => 'http://anyurl.com',
            'title' => 'Button title',
        ];

        $this->assertEquals($expected, $button->getButton());


        $button = new ButtonElement();
        $button->setType('postback');
        $button->setTitle('Button title 2');
        $button->setPayload('PAYLOAD1');

        $expected = [
            'type'    => 'postback',
            'title'   => 'Button title 2',
            'payload' => 'PAYLOAD1',
        ];

        $this->assertEquals($expected, $button->getButton());

    }

}

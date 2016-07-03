<?php

/*
 * This file is part of the FacebookBot package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FacebookBot\Test\Send;

use FacebookBot\Send\ButtonTemplate;
use FacebookBot\Send\Elements\ButtonElement;

class ButtonTemplateTest extends \PHPUnit_Framework_TestCase
{

    public function testText()
    {
        $buttonTemplate = new ButtonTemplate();
        $text  = 'anytext';
        $buttonTemplate->setText($text);
        $this->assertEquals($buttonTemplate->getText(), $text);
    }


    public function testButtons()
    {
        $buttonTemplate = new ButtonTemplate();
        $button = new ButtonElement();
        $buttonTemplate->setButton($button);
        $buttons = $buttonTemplate->getButtons();
        $this->assertCount(1, $buttons);
        $this->assertInstanceOf(ButtonElement::class, $buttons[0]);
    }


    public function testValidate()
    {
        $buttonTemplate = new ButtonTemplate();
        $buttonTemplate->setRecipientId(123456789);
        $buttonTemplate->validate();
    }

    /**
     * @expectedException RuntimeException
     */
    public function testValidateException()
    {
        $buttonTemplate = new ButtonTemplate();
        $buttonTemplate->validate();
    }


    public function testGetMessage()
    {
        $buttonTemplate = new ButtonTemplate();
        $buttonTemplate->setText('Button title');
        $buttonTemplate->setRecipientId(1230078913);

        $button = new ButtonElement();
        $button->setType(ButtonElement::TYPE_WEB_URL);
        $button->setTitle('BBC');
        $button->setUrl('http://bbc.com/');
        $buttonTemplate->setButton($button);

        $button = new ButtonElement();
        $button->setType(ButtonElement::TYPE_POSTBACK);
        $button->setTitle('Postback');
        $button->setPayload('POSTBACK');
        $buttonTemplate->setButton($button);

        $expected = [
            'recipient' =>
                [
                    'id' => 1230078913,
                ],
            'message' => [
                'attachment' => [
                    'type' => 'template',
                    'payload' => [
                        'template_type' => 'button',
                        'text'          => 'Button title',
                        'buttons'       => [
                            [
                                'type' => 'web_url',
                                'title' => 'BBC',
                                'url' => 'http://bbc.com/',
                            ],
                            [
                                'type' => 'postback',
                                'title' => 'Postback',
                                'payload' => 'POSTBACK',
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals($expected, $buttonTemplate->getMessage());
    }

}

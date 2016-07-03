<?php

/*
 * This file is part of the FacebookBot package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FacebookBot\Test\Send;

use FacebookBot\Send\TextMessage;

class TextMessageTest extends \PHPUnit_Framework_TestCase
{

    public function testText()
    {
        $textMessage = new TextMessage();
        $text  = 'anytext';
        $textMessage->setText($text);
        $this->assertEquals($textMessage->getText(), $text);
    }


    public function testValidate()
    {
        $textMessage = new TextMessage();
        $textMessage->setRecipientId(123456789);
        $textMessage->settext('anytext');
        $textMessage->validate();
    }

    /**
     * @expectedException RuntimeException
     */
    public function testValidateException()
    {
        $textMessage = new TextMessage();
        $textMessage->setRecipientId(123456789);
        $textMessage->validate();
    }

    public function testGetMessage()
    {
        $textMessage = new TextMessage();
        $textMessage->setRecipientId(123456789);
        $textMessage->settext('anytext');

        $expected = [
            'recipient' =>
                [
                    'id' => 123456789,
                ],
            'message' => [
                'text' => 'anytext',
            ],
        ];

        $this->assertEquals($expected, $textMessage->getMessage());
    }

}


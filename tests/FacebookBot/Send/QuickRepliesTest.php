<?php

/*
 * This file is part of the FacebookBot package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FacebookBot\Test\Send;

use FacebookBot\Send\QuickReplies;
use FacebookBot\Send\Elements\QuickReplyElement;


class QuickRepliesTest extends \PHPUnit_Framework_TestCase
{


    public function testValidate()
    {
        $quickReplies = new QuickReplies();
        $quickReplies->setRecipientId(1234546789);
        $quickReplies->setText('Text');
        $quickReplies->validate();
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testValidateException()
    {
        $quickReplies = new QuickReplies();
        $quickReplies->setRecipientId('123456789');
        $quickReplies->validate();
    }

    public function testAssertations()
    {
        $quickReplies = $this->getQuickReplies();

        $this->assertEquals('Title of reply', $quickReplies->getText());
        $this->assertEquals('12345679', $quickReplies->getRecipientId());
        $this->assertInstanceOf(QuickReplyElement::class, $quickReplies->getQuickReplyElements()[0]);
    }

    public function testGetMessage()
    {
        $quickReplies = $this->getQuickReplies();

        $expected = [
            'recipient' => [
                'id' => '12345679',
            ],
            'message' => [
                'text'          => 'Title of reply',
                'quick_replies' =>[
                    [
                        'content_type' => 'text',
                        'title'        => 'Title',
                        'payload'      => 'PAYLOAD',
                    ]
                ],
            ],
        ];
        $this->assertEquals($expected, $quickReplies->getMessage());
    }

    private function getQuickReplies()
    {
        $element = new QuickReplyElement();
        $element->setPayload('PAYLOAD');
        $element->setTitle('Title');

        $quickReplies = new QuickReplies();
        $quickReplies->setText('Title of reply');
        $quickReplies->setRecipientId('12345679');
        $quickReplies->addQuickReplyElement($element);

        return $quickReplies;
    }
}
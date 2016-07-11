<?php

/*
 * This file is part of the FacebookBot package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FacebookBot\Test\Webhook;

use FacebookBot\Webhook\Message;
use FacebookBot\Webhook\Request;

class MessageTest extends \PHPUnit_Framework_TestCase
{

    public function testAsserts()
    {
        $message = new Message;
        $message->setTimestamp(48495513);
        $message->setAttachment('http://video.url');
        $message->setPageId(56595613);
        $message->setPayload('PAYLOAD');
        $message->setRecipientId(48465456);
        $message->setSenderId(1231546);
        $message->setSeq(448);
        $message->setType(Request::TEXT);
        $message->setTextMessage('Message');

        $this->assertEquals(48495513, $message->getTimestamp());
        $this->assertEquals('http://video.url', $message->getAttachment());
        $this->assertEquals(56595613, $message->getPageId());
        $this->assertEquals('PAYLOAD', $message->getPayload());
        $this->assertEquals(48465456, $message->getRecipientId());
        $this->assertEquals(1231546, $message->getSenderId());
        $this->assertEquals(448, $message->getSeq());
        $this->assertEquals(Request::TEXT, $message->getType());
        $this->assertEquals('Message', $message->getTextMessage());
    }


    public function testToArray()
    {
        $message = new Message;
        $message->setTimestamp(48495513);
        $message->setAttachment('http://video.url');
        $message->setPageId(56595613);
        $message->setPayload('PAYLOAD');
        $message->setRecipientId(48465456);
        $message->setSenderId(1231546);
        $message->setSeq(448);
        $message->setType(Request::TEXT);
        $message->setTextMessage('Message');

        $expected = [
            'textMessage' => 'Message',
            'senderId' => 1231546,
            'timestamp' => 48495513,
            'type' => 'text',
            'payload' => 'PAYLOAD',
            'attachment' => 'http://video.url',
            'seq' => 448,
            'pageId' => 56595613,
            'recipientId' => 48465456,
        ];

        $this->assertEquals($expected, $message->toArray());
    }


}

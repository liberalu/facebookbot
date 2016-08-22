<?php

/*
 * This file is part of the FacebookBot package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FacebookBot\Test\Send\Element;

use FacebookBot\Send\Elements\QuickReplyElement;

class QuickReplyElementTest extends \PHPUnit_Framework_TestCase
{
    public function testAccessors()
    {
        $quickReplyElement = new QuickReplyElement();
        $quickReplyElement->setPayload('QUICK_REPLY_ELEMENT');
        $quickReplyElement->setTitle('Title');
        $quickReplyElement->setContentType('Text0');

        $this->assertEquals('QUICK_REPLY_ELEMENT', $quickReplyElement->getPayload());
        $this->assertEquals('Title', $quickReplyElement->getTitle());
        $this->assertEquals('Text0', $quickReplyElement->getContentType());
    }

    public function testGetQuickReplyElement()
    {
        $quickReplyElement = new QuickReplyElement();
        $quickReplyElement->setPayload('QUICK_REPLY_ELEMENT');
        $quickReplyElement->setTitle('Title');
        $quickReplyElement->setContentType('Text0');

        $expected = [
            'content_type' => 'Text0',
            'title'        => 'Title',
            'payload'      => 'QUICK_REPLY_ELEMENT',
        ];

        $this->assertEquals($expected, $quickReplyElement->getQuickReply());
    }
}

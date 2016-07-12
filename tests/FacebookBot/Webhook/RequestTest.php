<?php


/*
 * This file is part of the FacebookBot package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FacebookBot\Test\Webhook;


use FacebookBot\Webhook\Request;

class RequestTest extends \PHPUnit_Framework_TestCase
{
    public function testTextMessage()
    {
        $message = '{"object":"page","entry":[{"id":"112333","time":1467391768322,"messaging":[{"sender":{"id":"454985"},"recipient":{"id":"16553153"},"timestamp":1467391768299,"message":{"mid":"mid.1467391768290:2d3993d1327e3f1669","seq":748,"text":"Hello world"}}]}]}';
        $request = new Request(\json_decode($message, true), '45413215112');
        $this->assertEquals('Hello world', $request->getMessage()->getTextMessage());
        $this->assertEquals(Request::TEXT, $request->getMessage()->getType());
        $this->assertEquals(454985, $request->getMessage()->getSenderId());
        $this->assertEquals(1467391768322, $request->getMessage()->getTimestamp());
        $this->assertEquals(null, $request->getMessage()->getAttachment());
        $this->assertEquals(null, $request->getMessage()->getPayload());
        $this->assertEquals(748, $request->getMessage()->getSeq());
        $this->assertEquals(112333, $request->getMessage()->getPageId());
        $this->assertEquals(16553153, $request->getMessage()->getRecipientId());

    }


    public function testPayloadMessage()
    {
        $message = '{"object":"page","entry":[{"id":"112333","time":1467391768322,"messaging":[{"sender":{"id":"454985"},"recipient":{"id":"16553153"},"timestamp":1467391768299,"postback":{"payload":"USER_LAST_ORDER"}}]}]}';
        $request = new Request(\json_decode($message, true), '45413215112');
        $this->assertEquals(null, $request->getMessage()->getTextMessage());
        $this->assertEquals(Request::PAYLOAD, $request->getMessage()->getType());
        $this->assertEquals(454985, $request->getMessage()->getSenderId());
        $this->assertEquals(1467391768322, $request->getMessage()->getTimestamp());
        $this->assertEquals(null, $request->getMessage()->getAttachment());
        $this->assertEquals('USER_LAST_ORDER', $request->getMessage()->getPayload());
        $this->assertEquals(null, $request->getMessage()->getSeq());
        $this->assertEquals(112333, $request->getMessage()->getPageId());
        $this->assertEquals(16553153, $request->getMessage()->getRecipientId());

    }


    public function testAttachmentMessage()
    {
        $message = '{"object":"page","entry":[{"id":"112333","time":1467391768322,"messaging":[{"sender":{"id":"454985"},"recipient":{"id":"16553153"},"timestamp":1467391768299,"message":{"mid":"mid.1465588999979:822394bd9cb825a924","seq":643,"attachments":[{"type":"image","payload":{"url":"www"}}]}}]}]}';
        $request = new Request(\json_decode($message, true), '45413215112');
        $this->assertEquals(null, $request->getMessage()->getTextMessage());
        $this->assertEquals(Request::ATTACHMENT, $request->getMessage()->getType());
        $this->assertEquals(454985, $request->getMessage()->getSenderId());
        $this->assertEquals(1467391768322, $request->getMessage()->getTimestamp());
        $this->assertEquals('www', $request->getMessage()->getAttachment());
        $this->assertEquals(null, $request->getMessage()->getPayload());
        $this->assertEquals(643, $request->getMessage()->getSeq());
        $this->assertEquals(112333, $request->getMessage()->getPageId());
        $this->assertEquals(16553153, $request->getMessage()->getRecipientId());
    }


    public function testDeliveryMessage()
    {
        $message = '{"object":"page","entry":[{"id":"112333","time":1467391768322,"messaging":[{"sender":{"id":"454985"},"recipient":{"id":"16553153"},"timestamp":1467391768299,"delivery":{"mids":["mid.1468163082658:c0368c7d5847170825"],"watermark":1468163082953,"seq":920}}]}]}';
        $request = new Request(\json_decode($message, true), '45413215112');
        $this->assertEquals(null, $request->getMessage()->getTextMessage());
        $this->assertEquals(Request::DELIVERY, $request->getMessage()->getType());
        $this->assertEquals(454985, $request->getMessage()->getSenderId());
        $this->assertEquals(1467391768322, $request->getMessage()->getTimestamp());
        $this->assertEquals(null, $request->getMessage()->getAttachment());
        $this->assertEquals(null, $request->getMessage()->getPayload());
        $this->assertEquals(920, $request->getMessage()->getSeq());
        $this->assertEquals(112333, $request->getMessage()->getPageId());
        $this->assertEquals(16553153, $request->getMessage()->getRecipientId());
    }

    /**
     * @expectedException RuntimeException
     */
    public function testMessageWithoutType()
    {
        $message = '{"object":"page","entry":[{"id":"112333","time":1467391768322,"messaging":[{"sender":{"id":"454985"},"recipient":{"id":"16553153"},"timestamp":1467391768299, "any" : {}}]}]}';
        new Request(\json_decode($message, true), '45413215112');
    }


    public function testIsMessageValid()
    {
        $message = '{"object":"page","entry":[{"id":"112333","time":1467391768322,"messaging":[{"sender":{"id":"454985"},"recipient":{"id":"16553153"},"timestamp":1467391768299,"delivery":{"mids":["mid.1468163082658:c0368c7d5847170825"],"watermark":1468163082953,"seq":920}}]}]}';
        $request = new Request(\json_decode($message, true), '45413215112');
        $this->assertTrue($request->isMessageValid('sha1=724c4d1d9db786b9c9741d8d9c538a364f941229'));
    }
}

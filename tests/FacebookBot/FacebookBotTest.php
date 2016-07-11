<?php

/*
 * This file is part of the FacebookBot package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FacebookBot\Test;

use FacebookBot\FacebookBot;
use GuzzleHttp\Psr7\Response;
use FacebookBot\Send\TextMessage;

class FacebookBotTest extends \PHPUnit_Framework_TestCase
{

    public function testIsTokenInValid()
    {
        $fbBot = new FacebookBot('faketoken123456');
        $this->assertFalse($fbBot->isTokenValid());
    }


    public function testIsTokenValid()
    {
        $response = new Response(200, [], \json_encode(['success' => 1]));

        $fbBot = new FacebookBot('faketoken123456');
        $client = $this
            ->getMockBuilder('GuzzleHttp\Client')
            ->setMethods(['send'])
            ->getMock();
        $client->expects($this->any())->method('send')->will($this->returnValue($response));
        $fbBot->setClient($client);
        $this->assertTrue($fbBot->isTokenValid());
    }


    public function testSendMessage()
    {
        $response = new Response();

        $sendMessage = new TextMessage();
        $sendMessage->setText('Hello');
        $sendMessage->setRecipientId('123456789');


        $fbBot = new FacebookBot('faketoken123456');
        $client = $this
            ->getMockBuilder('GuzzleHttp\Client')
            ->setMethods(['send'])
            ->getMock();
        $client->expects($this->any())->method('send')->will($this->returnValue($response));
        $fbBot->setClient($client);
        $this->assertTrue($fbBot->sendMessage($sendMessage));
    }

}

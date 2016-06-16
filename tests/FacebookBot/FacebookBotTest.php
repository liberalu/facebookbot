<?php

namespace FacebookBot;


class FacebookBotTest extends \PHPUnit_Framework_TestCase
{


    /**
     * @covers FacebookBot::isTokenValid
     */
    public function testIsTokenValid()
    {
        $fbBot = new FacebookBot('faketoken123456');
        $this->assertFalse($fbBot->isTokenValid());
    }

}

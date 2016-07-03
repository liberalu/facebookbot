<?php

/*
 * This file is part of the FacebookBot package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FacebookBot\Test;

use FacebookBot\FacebookBot;

class FacebookBotTest extends \PHPUnit_Framework_TestCase
{

    public function testIsTokenValid()
    {
        $fbBot = new FacebookBot('faketoken123456');
        $this->assertFalse($fbBot->isTokenValid());
    }

}

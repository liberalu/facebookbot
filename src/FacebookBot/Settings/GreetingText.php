<?php

/*
 * This file is part of the FacebookBot package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FacebookBot\Settings;

use FacebookBot\Send\InterfaceMessage;

/**
 * Class GreetingText
 *
 * @package FacebookBot\Settings
 */
class GreetingText implements InterfaceMessage
{

    /** @var string */
    private $text;

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }


    /**
     * Get message send to Facebook
     *
     * @return array
     */
    public function getMessage()
    {
        return [
            'setting_type' => 'greeting',
            'greeting'     => [
                'text' => $this->getText(),
            ],
        ];
    }


    /**
     * Validate greeting text message
     */
    public function validate()
    {
        if (!$this->getText()) {
            throw new \RuntimeException('Text is not defined');
        }
    }
}
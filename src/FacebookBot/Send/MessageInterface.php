<?php

namespace FacebookBot\Send;


/**
 * Interface MessageInterface
 *
 * @package FacebookBot\Send
 */
Interface MessageInterface
{

    /**
     * Get message content
     *
     * @return array
     */
    public function getMessage();

    /**
     * Validate message before send to Facebook
     *
     * @return void
     */
    public function validate();
}

<?php

namespace FacebookBot\Send;


/**
 * Interface InterfaceMessage
 *
 * @package FacebookBot\Send
 */
Interface InterfaceMessage
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

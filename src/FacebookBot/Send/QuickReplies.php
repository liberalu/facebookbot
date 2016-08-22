<?php

/*
 * This file is part of the FacebookBot package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FacebookBot\Send;

use FacebookBot\Send\Elements\QuickReplyElement;

/**
 * Class QuickReplies
 *
 * @package FacebookBot\Send
 */
class QuickReplies extends AbstractMessage implements InterfaceMessage
{

    /** @var string */
    private $text = '';

    /** @var array */
    private $quickReplyElements = [];

    /**
     * Get message to send to Facebook
     *
     * @return array
     */
    public function getMessage()
    {
        $messageContent = [
            'text' => $this->getText(),
        ];

        $quickReplyElement = $this->getQuickReplyElements();

        /** @var QuickReplyElement $element */
        foreach ($quickReplyElement as $element) {
            $messageContent['quick_replies'][] = $element->getQuickReply();
        }

        return $this->responseContent($messageContent);
    }


    /**
     * Set text
     *
     * @param string $text message text
     */
    public function setText($text)
    {
        $this->text = $text;
    }


    /**
     * Get message text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return array
     */
    public function getQuickReplyElements()
    {
        return $this->quickReplyElements;
    }

    /**
     * Add QuickReplyElement object
     *
     * @param QuickReplyElement $quickReplyElement QuickReplyElement object
     */
    public function addQuickReplyElement(QuickReplyElement $quickReplyElement)
    {
        $this->quickReplyElements[] = $quickReplyElement;
    }

    /**
     * Validate message
     */
    public function validate()
    {
        parent::validate();
        if (!$this->getText()) {
            throw new \RuntimeException('Text is not defined');
        }
    }

}

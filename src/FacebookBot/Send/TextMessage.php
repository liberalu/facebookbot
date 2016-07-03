<?php

namespace FacebookBot\Send;

class TextMessage extends AbstractMessage implements InterfaceMessage
{

    /** @var string */
    private $text = '';


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

<?php

namespace FacebookBot\Send;

use FacebookBot\Send\Elements\ButtonElement;

/**
 * Class ButtonTemplate
 */
class ButtonTemplate extends AbstractMessage implements InterfaceMessage
{

    /** @var array */
    private $buttons = [];

    /** @var string */
    private $text = '';

    /**
     * Get message to send to Facebook
     *
     * @return array
     */
    public function getMessage()
    {

        $buttons = [];
        /** @var ButtonElement $buttonElement */
        foreach ($this->buttons as $buttonElement) {
            $buttons[] = $buttonElement->getButton();
        }

        $messageContent = [
            'attachment' => [
                'type' => 'template',
                'payload' => [
                    'template_type' => 'button',
                    'text'          => $this->getText(),
                    'buttons'       => $buttons,
                ],
            ],
        ];

        return $this->responseContent($messageContent);
    }


    /**
     * Set button
     *
     * @param ButtonElement $button element
     */
    public function setButton(ButtonElement $button)
    {
        $this->buttons[] = $button;
    }


    /**
     * Get buttons
     *
     * @return array
     */
    public function getButtons()
    {
        return $this->buttons;
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

    }

}

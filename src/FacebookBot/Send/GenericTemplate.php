<?php

/*
 * This file is part of the FacebookBot package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FacebookBot\Send;

use FacebookBot\Send\Elements\ItemElement;

/**
 * Class GenericTemplate
 */
class GenericTemplate extends AbstractMessage implements InterfaceMessage
{

    /** @var array */
    private $items = [];


    /**
     * Get message to send to Facebook
     *
     * @return array
     */
    public function getMessage()
    {

        $elements = [];

        /** @var ItemElement $item */
        foreach ($this->getItems() as $item) {
            $elements[] = $item->getItem();
        }

        $messageContent = [
            'attachment' => [
                'type' => 'template',
                'payload' => [
                    'template_type' => 'generic',
                    'elements' => $elements,
                ],
            ],
        ];

        return $this->responseContent($messageContent);
    }


    /**
     * Set ItemElement object
     *
     * @param ItemElement $item ItemElement object
     */
    public function setItem(ItemElement $item)
    {
        $this->items[] = $item;
    }

    /**
     * Get items
     *
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }


    /**
     * Validate message
     */
    public function validate()
    {
        parent::validate();

    }

}

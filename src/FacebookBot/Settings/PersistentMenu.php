<?php

/*
 * This file is part of the FacebookBot package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FacebookBot\Settings;

use FacebookBot\Send\InterfaceMessage;
use FacebookBot\Settings\Elements\ActionElement;

/**
 * Class PersistenMenu
 *
 * @package FacebookBot\Settings
 */
class PersistentMenu implements InterfaceMessage
{

    /** @var array */
    private $actions = [];


    /**
     * @return array
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * @param ActionElement $action ActionElement object
     */
    public function addAction(ActionElement $action)
    {
        $this->actions[] = $action;
    }

    /**
     * Get message send to Facebook
     *
     * @return array
     */
    public function getMessage()
    {
        $settings =  [
            'setting_type'    => 'call_to_actions',
            'thread_state'    => 'existing_thread',
            'call_to_actions' => [],
        ];

        $actions = $this->getActions();

        /** @var ActionElement $action */
        foreach ($actions as $action) {
            $settings['call_to_actions'][] = $action->getAction();
        }

        return $settings;
    }


    /**
     * Validate greeting text message
     */
    public function validate()
    {
        if (empty($this->getActions())) {
            throw new \RuntimeException('Text is not defined');
        }
    }
}
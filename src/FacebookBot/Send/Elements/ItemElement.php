<?php

/*
 * This file is part of the FacebookBot package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FacebookBot\Send\Elements;

use FacebookBot\Send\Elements\ButtonElement;

/**
 * Class ItemElement
 */
class ItemElement
{
    /** @var string */
    private $title;

    /** @var string */
    private $itemUrl;

    /** @var string */
    private $imageUrl;

    /** @var string */
    private $subTitle;

    /** @var array */
    private $buttons;


    /**
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }


    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }


    /**
     * Set item url
     *
     * @param string $itemUrl
     */
    public function setItemUrl($itemUrl)
    {
        $this->itemUrl = $itemUrl;
    }


    /**
     * Get item url
     *
     * @return string
     */
    public function getItemUrl()
    {
        return $this->itemUrl;
    }


    /**
     * Set image url
     *
     * @param string $imageUrl
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;
    }


    /**
     * Get image url
     *
     * @return string
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }


    /**
     * Set subTitle
     *
     * @param string $subTitle
     */
    public function setSubTitle($subTitle)
    {
        $this->subTitle = $subTitle;
    }


    /**
     * Get subTitle
     *
     * @return string
     */
    public function getSubTitle()
    {
        return $this->subTitle;
    }


    /**
     * Set button
     *
     * @param ButtonElement
     */
    public function setButton(ButtonElement $button)
    {
        $this->buttons[] = $button;
    }


    /**
     * Get buttons
     *
     * @return string
     */
    public function getButtons()
    {
        return $this->buttons;
    }

    /**
     * Get item
     *
     * @return array
     */
    public function getItem()
    {
        $return = [
            'title' => $this->getTitle(),
        ];


        if (!empty($this->getItemUrl())) {
            $return['item_url'] = $this->getItemUrl();
        }

        if (!empty($this->getImageUrl())) {
            $return['image_url'] = $this->getImageUrl();
        }

        if (!empty($this->getSubTitle())) {
            $return['subtitle'] = $this->getSubTitle();
        }

        if (!empty($this->getButtons())) {
            $buttons = $this->getButtons();
            /** @var ButtonElement $button */
            foreach ($buttons as $button) {
                $return['buttons'][] = $button->getButton();
            }
        }

        return $return;
    }

}

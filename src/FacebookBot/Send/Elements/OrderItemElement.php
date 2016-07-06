<?php

/*
 * This file is part of the FacebookBot package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FacebookBot\Send\Elements;


/**
 * Class OrderItemElement
 */
class OrderItemElement
{
    /** @var string */
    private $title;

    /** @var string */
    private $subTitle;

    /** @var int */
    private $quantity;

    /** @var float */
    private $price;

    /** @var string */
    private $currency;

    /** @var string */
    private $imageUrl;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getSubTitle()
    {
        return $this->subTitle;
    }

    /**
     * @param string $subTitle
     */
    public function setSubTitle($subTitle)
    {
        $this->subTitle = $subTitle;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * @param string $imageUrl
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;
    }


    /**
     * Get order item
     *
     * @return array
     */
    public function getOrderItem()
    {
        $orderItem = [
            'title' => $this->getTitle(),
            'price' => 0,
        ];

        if (!empty($this->getSubTitle())) {
            $orderItem['subTitle'] = $this->getSubTitle();
        }

        if (!empty($this->getQuantity())) {
            $orderItem['quantity'] = $this->getQuantity();
        }

        if (!empty($this->getPrice())) {
            $orderItem['price'] = $this->getPrice();
        }

        if (!empty($this->getCurrency())) {
            $orderItem['currency'] = $this->getCurrency();
        }

        if (!empty($this->getImageUrl())) {
            $orderItem['image_url'] = $this->getImageUrl();
        }

        return $orderItem;
    }

}

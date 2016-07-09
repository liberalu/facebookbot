<?php

/*
 * This file is part of the FacebookBot package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FacebookBot\Send;

use FacebookBot\Send\Elements\AddressElement;
use FacebookBot\Send\Elements\OrderItemElement;
use FacebookBot\Send\Elements\SummaryElement;
use FacebookBot\Send\Elements\AdjustmentElement;

/**
 * Class ReceiptTemplate
 */
class ReceiptTemplate extends AbstractMessage implements InterfaceMessage
{

    /** @var string */
    private $recipientName;

    /** @var string */
    private $orderNumber;

    /** @var string */
    private $currency;

    /** @var string */
    private $paymentMethod;

    /** @var string */
    private $orderUrl;

    /** @var string */
    private $timestamp;

    /** @var AddressElement */
    private $address;

    /** @var array */
    private $orderItems;

    /** @var  SummaryElement */
    private $summary;

    /** @var array */
    private $adjustments;

    /**
     * @return array
     */
    public function getAdjustments()
    {
        return $this->adjustments;
    }

    /**
     * @param AdjustmentElement $adjustments
     */
    public function addAdjustments(AdjustmentElement $adjustments)
    {
        $this->adjustments[] = $adjustments;
    }

    /**
     * @return SummaryElement
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @param SummaryElement $summary
     */
    public function setSummary(SummaryElement $summary)
    {
        $this->summary = $summary;
    }

    /**
     * @return string
     */
    public function getRecipientName()
    {
        return $this->recipientName;
    }

    /**
     * @param string $recipientName
     */
    public function setRecipientName($recipientName)
    {
        $this->recipientName = $recipientName;
    }

    /**
     * @return string
     */
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

    /**
     * @param string $orderNumber
     */
    public function setOrderNumber($orderNumber)
    {
        $this->orderNumber = $orderNumber;
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
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * @param string $paymentMethod
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
    }

    /**
     * @return string
     */
    public function getOrderUrl()
    {
        return $this->orderUrl;
    }

    /**
     * @param string $orderUrl
     */
    public function setOrderUrl($orderUrl)
    {
        $this->orderUrl = $orderUrl;
    }

    /**
     * @return string
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @param string $timestamp
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }

    /**
     * @return AddressElement
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param AddressElement $address
     */
    public function setAddress(AddressElement $address)
    {
        $this->address = $address;
    }

    /**
     * @return array
     */
    public function getOrderItems()
    {
        return $this->orderItems;
    }

    /**
     * @param OrderItemElement $orderItem
     */
    public function addOrderItems(OrderItemElement $orderItem)
    {
        $this->orderItems[] = $orderItem;
    }

    /**
     * Get message to send to Facebook
     *
     * @return array
     */
    public function getMessage()
    {

        $elements = [];

        /** @var OrderItemElement $item */
        foreach ($this->getOrderItems() as $item) {
            $elements[] = $item->getOrderItem();
        }

        $payload = [
            'template_type'  => 'receipt',
            'recipient_name' => $this->getRecipientName(),
            'order_number'   => $this->getOrderNumber(),
            'currency'       => $this->getCurrency(),
            'payment_method' => $this->getPaymentMethod(),
            'elements'       => $elements,
            'summary'        => $this->getSummary()->getSummary(),
            'address'        => $this->getAddress()->getAddress(),
        ];

        if (!empty($this->getTimestamp())) {
            $payload['timestamp'] = $this->getTimestamp();
        }

        if (!empty($this->getOrderUrl())) {
            $payload['order_url'] = $this->getOrderUrl();
        }

        if (!empty($this->getAdjustments())) {
            $adjustments = $this->getAdjustments();
            $payload['adjustments'] = [];
            /** @var AdjustmentElement $adjustment */
            foreach ($adjustments as $adjustment) {
                $payload['adjustments'][] = $adjustment->getAsjustment();
            }
        }

        $messageContent = [
            'attachment' => [
                'type' => 'template',
                'payload' => $payload,
            ],
        ];

        return $this->responseContent($messageContent);
    }

    /**
     * Validate message
     */
    public function validate()
    {
        parent::validate();

    }

}

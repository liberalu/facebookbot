<?php

/*
 * This file is part of the FacebookBot package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FacebookBot\Test\Send;

use FacebookBot\Send\ReceiptTemplate;
use FacebookBot\Send\Elements\AddressElement;
use FacebookBot\Send\Elements\OrderItemElement;
use FacebookBot\Send\Elements\SummaryElement;
use FacebookBot\Send\Elements\AdjustmentElement;


class ReceiptTemplateTest extends \PHPUnit_Framework_TestCase
{


    public function testValidate()
    {
        $receiptTemplate = new ReceiptTemplate();
        $receiptTemplate->setRecipientId(1234546789);
        $receiptTemplate->validate();
    }

    /**
     * @expectedException RuntimeException
     */
    public function testValidateException()
    {
        $receiptTemplate = new ReceiptTemplate();
        $receiptTemplate->validate();
    }


    public function testAssertations()
    {
        $receiptTemplate = $this->getRereipt();

        $this->assertEquals('EUR', $receiptTemplate->getCurrency());
        $this->assertEquals('1253SK', $receiptTemplate->getOrderNumber());
        $this->assertEquals('http://order.url', $receiptTemplate->getOrderUrl());
        $this->assertEquals('Johan Smith', $receiptTemplate->getRecipientName());
        $this->assertEquals('Visa Card 89', $receiptTemplate->getPaymentMethod());
        $this->assertEquals(159712123, $receiptTemplate->getRecipientId());
        $this->assertEquals(4123513512, $receiptTemplate->getTimestamp());

        $this->assertInstanceOf(SummaryElement::class, $receiptTemplate->getSummary());
        $this->assertInstanceOf(AddressElement::class, $receiptTemplate->getAddress());
        $this->assertInstanceOf(OrderItemElement::class, $receiptTemplate->getOrderItems()[0]);
        $this->assertInstanceOf(AdjustmentElement::class, $receiptTemplate->getAdjustments()[0]);
    }


    public function testGetMessage()
    {
        $receiptTemplate = $this->getRereipt();
        $message = [
            'template_type'  => 'receipt',
            'recipient_name' => 'Johan Smith',
            'order_number' => '1253SK',
            'currency' => 'EUR',
            'payment_method' => 'Visa Card 89',
            'order_url' => 'http://order.url',
            'timestamp' => 4123513512,
            'address' => [
                'street1' => 'Street 1',
                'street2' => 'Street 2',
                'city' => 'City',
                'postal_code' => '12345a',
                'state' => 'State',
                'country' => 'Country',
            ],
            'elements' => [
                [
                    'title' => 'Title',
                    'subTitle' => 'Subtitle',
                    'quantity' => 4,
                    'price' => 21.5,
                    'currency' => 'EUR',
                    'image_url' => 'http://image.url',
                ],
            ],
            'summary' => [
                'subtotal' => 10,
                'shipping_cost' => 27,
                'total_tax' => 21,
                'total_cost' => 15,
            ],
            'adjustments' => [
                [
                    'name' => 'name',
                    'amount' => 'amount',
                ],
            ],
        ];

        $expected = [
            'recipient' => [
                'id' => 159712123,
            ],
            'message' => [
                'attachment' => [
                    'type' => 'template',
                    'payload' => $message,
                ],
            ],
        ];

        $this->assertEquals($expected, $receiptTemplate->getMessage());

    }


    private function getRereipt()
    {
        $address = new AddressElement();
        $address->setCity('City');
        $address->setCountry('Country');
        $address->setPostalCode('12345a');
        $address->setState('State');
        $address->setStreet('Street 1');
        $address->setStreet2('Street 2');

        $summary = new SummaryElement();
        $summary->setSubtotal(10);
        $summary->setTotalCost(15);
        $summary->setTotalTax(21);
        $summary->setShippingCost(27);

        $orderItem = new OrderItemElement();
        $orderItem->setCurrency('EUR');
        $orderItem->setImageUrl('http://image.url');
        $orderItem->setPrice(21.5);
        $orderItem->setQuantity(4);
        $orderItem->setSubTitle('Subtitle');
        $orderItem->setTitle('Title');

        $adjustment = new AdjustmentElement();
        $adjustment->setAmount('amount');
        $adjustment->setName('name');

        $receiptTemplate = new ReceiptTemplate();
        $receiptTemplate->setCurrency('EUR');
        $receiptTemplate->setOrderNumber('1253SK');
        $receiptTemplate->setOrderUrl('http://order.url');
        $receiptTemplate->setPaymentMethod('Visa Card 89');
        $receiptTemplate->setRecipientName('Johan Smith');
        $receiptTemplate->setRecipientId(159712123);
        $receiptTemplate->setTimestamp(4123513512);
        $receiptTemplate->setSummary($summary);
        $receiptTemplate->setAddress($address);
        $receiptTemplate->addOrderItems($orderItem);
        $receiptTemplate->addAdjustments($adjustment);

        return $receiptTemplate;
    }

}

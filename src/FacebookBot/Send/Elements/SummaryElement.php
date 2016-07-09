<?php

/*
 * This file is part of the FacebookBot package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FacebookBot\Send\Elements;


/**
 * Class SummaryElement
 */
class SummaryElement
{

    /**
     * @var int
     */
    private $subtotal = 0;
    /**
     * @var int
     */
    private $shippingCost = 0;
    /**
     * @var int
     */
    private $totalTax = 0;
    /**
     * @var int
     */
    private $totalCost = 0;

    /**
     * @return int
     */
    public function getSubtotal()
    {
        return $this->subtotal;
    }

    /**
     * @param int $subtotal
     */
    public function setSubtotal($subtotal)
    {
        $this->subtotal = $subtotal;
    }

    /**
     * @return int
     */
    public function getShippingCost()
    {
        return $this->shippingCost;
    }

    /**
     * @param int $shippingCost
     */
    public function setShippingCost($shippingCost)
    {
        $this->shippingCost = $shippingCost;
    }

    /**
     * @return int
     */
    public function getTotalTax()
    {
        return $this->totalTax;
    }

    /**
     * @param int $totalTax
     */
    public function setTotalTax($totalTax)
    {
        $this->totalTax = $totalTax;
    }

    /**
     * @return int
     */
    public function getTotalCost()
    {
        return $this->totalCost;
    }

    /**
     * @param int $totalCost
     */
    public function setTotalCost($totalCost)
    {
        $this->totalCost = $totalCost;
    }


    /**
     * Get summary
     *
     * @return array
     */
    public function getSummary()
    {
        $summary = [
            'total_cost' => $this->getTotalCost(),
        ];

        if (!empty($this->getSubtotal())) {
            $summary['subtotal'] = $this->getSubtotal();
        }

        if (!empty($this->getShippingCost())) {
            $summary['shipping_cost'] = $this->getShippingCost();
        }

        if (!empty($this->getTotalTax())) {
            $summary['total_tax'] = $this->getTotalTax();
        }

        return $summary;
    }
}

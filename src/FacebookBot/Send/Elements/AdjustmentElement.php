<?php
/*
 * This file is part of the FacebookBot package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FacebookBot\Send\Elements;


/**
 * Class AdjustmentElement
 */
class AdjustmentElement
{

    /**
     * @var string
     */
    private $name;

    /**
     * @var float
     */
    private $amount = 0.0;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }


    /**
     * Ger adjustment
     *
     * @return array
     */
    public function getAsjustment()
    {
        $adjustment = [];

        if (!empty($this->getName())) {
            $adjustment['name'] = $this->getName();
        }

        if (!empty($this->getAmount())) {
            $adjustment['amount'] = $this->getAmount();
        }

        return $adjustment;
    }

}

<?php
/*
 * This file is part of the FacebookBot package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FacebookBot\Send\Elements;


/**
 * Class AddressElement
 */
class AddressElement
{

    /**
     * @var string
     */
    private $street;

    /**
     * @var string
     */
    private $street2;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $postalCode;

    /**
     * @var string
     */
    private $state;

    /**
     * @var string
     */
    private $country;


    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }


    /**
     * @param string $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }


    /**
     * @return string
     */
    public function getStreet2()
    {
        return $this->street2;
    }


    /**
     * @param string $street2
     */
    public function setStreet2($street2)
    {
        $this->street2 = $street2;
    }


    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }


    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }


    /**
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }


    /**
     * @param string $postalCode
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    }


    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }


    /**
     * @param string $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }


    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }


    /**
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }


    /**
     * Get address
     *
     * @return array
     */
    public function getAddress()
    {
        $address = [
            'street1'     => $this->getStreet(),
            'street2'     => $this->getStreet2(),
            'city'        => $this->getCity(),
            'postal_code' => $this->getPostalCode(),
            'state'       => $this->getState(),
            'country'     => $this->getCountry(),
        ];

        return $address;
    }

}

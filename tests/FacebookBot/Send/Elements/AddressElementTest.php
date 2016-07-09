<?php

/*
 * This file is part of the FacebookBot package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FacebookBot\Test\Send\Element;

use FacebookBot\Send\Elements\AddressElement;

class AddressElementTest extends \PHPUnit_Framework_TestCase
{

    public function testAccessors()
    {

        $address = new AddressElement();
        $address->setCity('City');
        $address->setCountry('Country');
        $address->setPostalCode('12345a');
        $address->setState('State');
        $address->setStreet('Street 1');
        $address->setStreet2('Street 2');

        $this->assertEquals('City', $address->getCity());
        $this->assertEquals('Country', $address->getCountry());
        $this->assertEquals('12345a', $address->getPostalCode());
        $this->assertEquals('State', $address->getState());
        $this->assertEquals('Street 1', $address->getStreet());
        $this->assertEquals('Street 2', $address->getStreet2());
    }


    public function testGetAddress()
    {
        $address = new AddressElement();
        $address->setCity('City');
        $address->setCountry('Country');
        $address->setPostalCode('12345a');
        $address->setState('State');
        $address->setStreet('Street 1');
        $address->setStreet2('Street 2');

        $expected = [
            'street1' => 'Street 1',
            'street2' => 'Street 2',
            'city' => 'City',
            'postal_code' => '12345a',
            'state' => 'State',
            'country' => 'Country',
        ];

        $this->assertEquals($expected, $address->getAddress());

    }

}
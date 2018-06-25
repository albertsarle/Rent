<?php

namespace AlbertSP\Rent;

class Property
{
    /**
     * Property's name
     *
     * @var string
     */
    protected $name;

    /**
     * Property's City name
     *
     * @var string
     */
    protected $city;

    /**
     * Property's address in the city
     *
     * @var string
     */
    protected $address;

    /**
     * Match constructor.
     * @param $name
     * @param $city
     * @param $address
     */
    public function __construct($name, $city, $address)
    {
        $this->city = $city;
        $this->address = $address;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }
    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }
}

<?php

namespace AlbertSP\Rent;

class Property extends Named
{
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
    public function getCity(): string
    {
        return $this->city;
    }
    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }
}

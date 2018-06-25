<?php

namespace AlbertSP\Rent;

class Owner
{
    /**
     * Owner's name
     *
     * @var string
     */
    protected $name;

    /**
     * Properties List
     * @var array
     */
    protected $properties;

    /**
     * Match constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
        $this->properties= [];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getProperties(): array
    {
        return $this->properties;
    }

    /**
     * @param Property $property
     */
    public function addProperty(Property $property)
    {
        array_push($this->properties, $property);
    }

    /**
     * Get a Property of the Owners List by its name
     * @param $propertyName
     * @return mixed
     */
    public function getPropertyByName($propertyName)
    {
        $filtered = array_filter(
            $this->properties,
            function ($item) use ($propertyName) {
                return $item->getName() == $propertyName;
            }
        );

        return array_shift($filtered);
    }

    /**
     * Get a Property of the Owners List by its name
     * @param $cityName
     * @return mixed
     */
    public function getPropertyByCity($cityName)
    {
        return array_filter(
            $this->properties,
            function ($item) use ($cityName) {
                return $item->getCity() == $cityName;
            }
        );
    }
}

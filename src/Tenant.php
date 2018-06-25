<?php

namespace AlbertSP\Rent;

class Tenant extends Named
{
    /**
     * Tenant constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }
}

<?php

namespace AlbertSP\Rent;

class Tenant
{
    /**
     * Tenant Nameº
     *
     * @var [type]
     */
    protected $name;

    /**
     * Match constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}

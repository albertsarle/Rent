<?php

namespace AlbertSP\Rent;

abstract class Named implements NamedInterface
{
    /**
     * Named's name
     *
     * @var string
     */
    protected $name;

    /**
     * Get Named's name
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
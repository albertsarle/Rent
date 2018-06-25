<?php

namespace AlbertSP\Rent;

use DateInterval;
use DateTime;

class Rental
{
    /**
     * Max Years for current Rentals
     */
    const RENTAL_YEARS =  3;
    /**
     * Default Rental Cost
     */
    const DEFAULT_COST_EUROS =  750;
    /**
     * Days to consider thar the Rental is close to expiry
     */
    const EXPIRY_INTERVAL_DAYS = 30;

    /**
     * Start Date of the Rental
     *
     * @var DateTime
     */
    protected $dateStart;

    /**
    * End Date of the Rental
    *
    * @var DateTime
    */
    protected $dateEnd;

    /**
     * Monthly cost of the Rental in euros
     *
     * @var integer
     */
    protected $monthlyCost;

    /**
     * The Property object which is being rented
     *
     * @var Property
     */
    protected $property;

    /**
     * The Owner object of the Rental
     *
     * @var Owner
     */
    protected $owner;

    /**
     * The Tenant Object for the current Rental
     *
     * @var [type]
     */
    protected $tenant;

    /**
     * Rental constructor.
     * @param Owner $owner
     * @param Property $property
     * @param Tenant $tenant
     * @throws \Exception
     */
    public function __construct(Owner $owner, Property $property, Tenant $tenant)
    {
        $this->owner = $owner;
        $this->property = $property;
        $this->tenant = $tenant;

        // default values
        $this->dateStart = new DateTime('2018-06-25 00:00:00');
        $tmpDate = clone $this->dateStart;
        $this->dateEnd = $tmpDate->add(new DateInterval('P'. self::RENTAL_YEARS.'Y'));
        $this->monthlyCost = self::DEFAULT_COST_EUROS;
    }

    /**
     * @return DateTime
     */
    public function getDateStart(): DateTime
    {
        return $this->dateStart;
    }

    /**
     * @param DateTime $dateStart
     */
    public function setDateStart(DateTime $dateStart): void
    {
        $this->dateStart = $dateStart;
    }

    /**
     * @return DateTime
     */
    public function getDateEnd(): DateTime
    {
        return $this->dateEnd;
    }

    /**
     * @param static $dateEnd
     */
    public function setDateEnd($dateEnd): void
    {
        $this->dateEnd = $dateEnd;
    }

    /**
     * @return int
     */
    public function getMonthlyCost(): int
    {
        return $this->monthlyCost;
    }

    /**
     * @return Property
     */
    public function getProperty(): Property
    {
        return $this->property;
    }

    /**
     * @return Owner
     */
    public function getOwner(): Owner
    {
        return $this->owner;
    }

    /**
     * @return Tenant
     */
    public function getTenant(): Tenant
    {
        return $this->tenant;
    }

    /**
     * Determines if the Rental is about to expiry soon (in the next EXPIRY_INTERVAL_DAYS)
     * @return bool
     */
    public function expiresSoon(): bool
    {
        $today = new DateTime();
        $daysToExpiry = $today->diff($this->getDateEnd());

        return $daysToExpiry->days < self::EXPIRY_INTERVAL_DAYS;
    }
}

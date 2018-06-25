<?php

use PHPUnit\Framework\TestCase;
use AlbertSP\Rent\Owner;
use AlbertSP\Rent\Property;
use AlbertSP\Rent\Rental;
use AlbertSP\Rent\Tenant;

class RentTest extends TestCase
{
    private $owner;
    private $tenant;
    private $tmpProperty1;
    private $tmpProperty2;
    private $tmpProperty3;
    private $tmpProperty4;

    private $tmpRental1;

    public function setUp()
    {
        $this->owner = new Owner('Albert');
        $this->tenant = new Tenant('Joan');

        $this->tmpProperty1 = new Property('Casa avis', 'Terrassa', 'Vint-i-dos de Juliol 178 Bxs');
        $this->tmpProperty2 = new Property('Pis solter', 'Sabadell', 'Advocat Cirera 17');
        $this->tmpProperty3 = new Property('Pis Tiet', 'Sabadell', 'Montserrat 34');
        $this->tmpProperty4 = new Property('Solar', 'Sabadell', 'Esplanada de Can Deu');

        $this->tmpRental1 = new Rental($this->owner, $this->tmpProperty1, $this->tenant);
    }

    public function testAPropertyHasAName() {
        $this->assertNotEmpty($this->tmpProperty1->getName());
    }

    public function testAnOwnerHasAName() {
        $this->assertEquals('Albert', $this->owner->getName());
    }

    public function testATenantHasAName() {
        $this->assertEquals('Joan', $this->tenant->getName());
    }

    public function testAnOwnerHasPropertiesList() {
        $this->assertInternalType('array', $this->owner->getProperties());
    }

    public function testAnOwnerCanAddPropertiesToThePropertiesList() {
        $this->owner->addProperty($this->tmpProperty1);
        $this->assertCount(1, $this->owner->getProperties());

        $this->owner->addProperty($this->tmpProperty2);
        $this->assertCount(2, $this->owner->getProperties());
    }

    public function testAnOwnerCanRetrievePropertiesFromThePropertiesList() {

        $this->owner->addProperty($this->tmpProperty1);
        $this->owner->addProperty($this->tmpProperty2);
        $properties = $this->owner->getProperties();

        $this->assertSame($this->tmpProperty1, $properties[0]);
        $this->assertSame($this->tmpProperty2, $properties[1]);
    }

    public function testAnOwnerCanSearchAPropertyByName()
    {
        $this->owner->addProperty($this->tmpProperty1);
        $this->owner->addProperty($this->tmpProperty2);

        $foundProperty = $this->owner->getPropertyByName('Pis solter');
        $this->assertSame($this->tmpProperty2, $foundProperty);
    }

    public function testAnOwnerCanSearchPropertiesByCity()
    {
        $this->owner->addProperty($this->tmpProperty1);
        $this->owner->addProperty($this->tmpProperty2);
        $this->owner->addProperty($this->tmpProperty3);
        $this->owner->addProperty($this->tmpProperty4);

        $propertiesByCity = $this->owner->getPropertiesByCity('Sabadell');
        $this->assertCount(3, $propertiesByCity);
    }

    public function testARentalHasMinimumData()
    {
        $this->assertEquals(new DateTime('2018-06-25 00:00:00'), $this->tmpRental1->getDateStart());
        // assumed 3 years contract as specified in Rental::RENTAL_YEARS
        $this->assertEquals(new DateTime('2021-06-25 00:00:00'), $this->tmpRental1->getDateEnd());
        $this->assertEquals(750, $this->tmpRental1->getMonthlyCost());
    }

    public function testARentalHasAProperty()
    {
        $rentalProperty = $this->tmpRental1->getProperty();
        $this->assertSame($this->tmpProperty1, $rentalProperty);
    }

    public function testARentalHasAnOwner()
    {
        $rentalOwner = $this->tmpRental1->getOwner();
        $this->assertSame($this->owner, $rentalOwner);
    }

    public function testARentalHasATenant()
    {
        $rentalTenant = $this->tmpRental1->getTenant();
        $this->assertSame($this->tenant, $rentalTenant);
    }

    public function testARentalDoesNotExpireSoon()
    {
        $nonExpiringRental = $this->tmpRental1;

        // assume Rental started 2.5 years ago
        $dateStart = new DateTime();
        $dateStart->sub(New DateInterval('P30M'));
        $nonExpiringRental->setDateStart($dateStart);

        $dateEnd = new DateTime();
        $dateEnd->add(New DateInterval('P6M'));
        $nonExpiringRental->setDateEnd($dateEnd);

        $this->assertFalse($nonExpiringRental->expiresSoon());
    }
    public function testARentalExpiresSoon()
    {
        $nonExpiringRental = $this->tmpRental1;

        // assume Rental started 2 years, 11 months and 15 days ago
        // 3 years * 365 days = 1095 ; 1095 -15 days = 1080 days
        $dateStart = new DateTime();
        $dateStart->sub(New DateInterval('P1080M'));
        $nonExpiringRental->setDateStart($dateStart);

        $dateEnd = new DateTime();
        $dateEnd->add(New DateInterval('P15D'));
        $nonExpiringRental->setDateEnd($dateEnd);

        $this->assertTrue($nonExpiringRental->expiresSoon());
    }
}

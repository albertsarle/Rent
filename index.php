<?php

use AlbertSP\Property;
use AlbertSP\Rental;

require "vendor/autoload.php";

$owner = new \AlbertSP\Owner('Albert AlbertSP');
echo "<h1>Owner name : " . $owner->getName() . "</h1>";


$properties = [
    new Property('Casa avis', 'Terrassa', 'Vint-i-dos de Juliol 178 Bxs'),
    new Property('Pis solter', 'Sabadell', 'Advocat Cirera 17'),
    new Property('Pis Tiet', 'Sabadell', 'Montserrat 34'),
    new Property('Solar', 'Sabadell', 'Esplanada de Can Deu')
];

echo "<br>Owner Properties:";
if (count($properties))
{
    echo "<ul>";
    foreach($properties as $key => $property) {
        $owner->addProperty($property);
        echo "<li>". $property->getName() ."</li>";
    }
    echo "</ul>";
}

$tenant = new \AlbertSP\Tenant('Joan Farre');
echo "<h1>Tenant name : " .  $tenant->getName() . "</h1>";

echo "<h1>Rent info: </h1>";

$rental1 = new Rental($owner, $properties[0], $tenant);
echo "<br>Owner : ". $rental1->getOwner()->getName();
echo "<br>Tenant : ". $rental1->getTenant()->getName();

// assume Rental started 2 years, 11 months and 15 days ago
// 3 years * 365 days = 1095 ; 1095 -15 days = 1080 days
$dateStart = new DateTime();
$dateStart->sub(New DateInterval('P1080D'));
$rental1->setDateStart($dateStart);

$dateEnd = new DateTime();
$dateEnd->add(New DateInterval('P15D'));
$rental1->setDateEnd($dateEnd);

echo "<br>Date Start: ". $rental1->getDateStart()->format('d-M-Y');
echo "<br>Date End: ". $rental1->getDateEnd()->format('d-M-Y');
echo "<br>Is Rent Expiring Soon? ". ($rental1->expiresSoon() ? 'Yes' : 'No');




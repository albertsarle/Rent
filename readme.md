# Rent

Rent is a library to help managing Property Rental contracts between Owners and Tenants.

Rentaloffers a few key features:
- Create Relationships between Owners and Tenants
- Get notified when a Rental is about to expiry

## Installation

Here's how to use Rent:

install via composer adding the public repo in github

    "repositories": [
        {
            "url": "https://github.com/albertsarle/Rent.git",
            "type": "git"
        }
    ],
    "require-dev": {
        "AlbertSP/rent": "dev-master"
    }

## Usage

See index.php for an example

    use AlbertSP\Rent\Property;
    use AlbertSP\Rent\Owner;
    use AlbertSP\Rent\Rental;
    use AlbertSP\Rent\Tenant;
    
    $owner = new Owner('Albert AlbertSP');
    
    $properties = [
        new Property('Casa avis', 'Terrassa', 'Vint-i-dos de Juliol 178 Bxs'),
        new Property('Pis solter', 'Sabadell', 'Advocat Cirera 17'),
        new Property('Pis Tiet', 'Sabadell', 'Montserrat 34'),
        new Property('Solar', 'Sabadell', 'Esplanada de Can Deu')
    ];
    
    $tenant = new \AlbertSP\Tenant('Joan FB');
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




## Contributing

1. Fork it!
2. Create your feature branch: `git checkout -b my-new-feature`
3. Commit your changes: `git commit -am 'Add some feature'`
4. Push to the branch: `git push origin my-new-feature`
5. Submit a pull request :D

## History

Version 0.1 (2018-06-25) - Initial version

## Credits

Albert SP - 

## License

MIT License

Copyright (c) 2018 Albert SP

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

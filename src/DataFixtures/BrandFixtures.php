<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BrandFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $brands = [
            [
                'brandName' => 'Mercedes-Benz',
                'brandImage' => 'https://upload.wikimedia.org/wikipedia/commons/9/90/Mercedes-Logo.svg',
                'rating' => 3,
                'tragetCountries' => ['FR', 'DE', 'CM'],
                'type' => 'new'
            ],
            [
                'brandName' => 'Orange',
                'brandImage' => 'https://upload.wikimedia.org/wikipedia/commons/6/65/No-Image-Placeholder.svg',
                'rating' => 2,
                'tragetCountries' => ['SN', 'CM', 'FR'],
                'type' => 'new'
            ],
            [
                'brandName' => 'Toyota',
                'brandImage' => 'https://upload.wikimedia.org/wikipedia/commons/6/65/No-Image-Placeholder.svg',
                'rating' => 4,
                'tragetCountries' => ['FR', 'CM', 'US'],
                'type' => 'default'
            ],
            [
                'brandName' => 'MtN',
                'brandImage' => 'https://upload.wikimedia.org/wikipedia/commons/6/65/No-Image-Placeholder.svg',
                'rating' => 3,
                'tragetCountries' => ['FR', 'CM', 'NR'],
                'type' => 'default'
            ],
            [
                'brandName' => 'Samsung',
                'brandImage' => 'https://upload.wikimedia.org/wikipedia/commons/2/24/Samsung_Logo.svg',
                'rating' => 3,
                'tragetCountries' => ['CM', 'RU', 'FR'],
                'type' => 'new'
            ],
            [
                'brandName' => 'Apple',
                'brandImage' => 'https://upload.wikimedia.org/wikipedia/commons/f/fa/Apple_logo_black.svg',
                'rating' => 4,
                'tragetCountries' => ['FR', 'CM', 'US'],
                'type' => 'featured'
            ],
            [
                'brandName' => 'Google',
                'brandImage' => 'https://upload.wikimedia.org/wikipedia/commons/2/2f/Google_2015_logo.svg',
                'rating' => 5,
                'tragetCountries' => ['FR', 'IN', 'CM'],
                'type' => 'featured'
            ],
            [
                'brandName' => 'Amazon',
                'brandImage' => 'https://upload.wikimedia.org/wikipedia/commons/a/a9/Amazon_logo.svg',
                'rating' => 5,
                'tragetCountries' => ['FR', 'IN', 'CM'],
                'type' => 'featured'
            ],[
                'brandName' => 'Microsoft',
                'brandImage' => 'https://upload.wikimedia.org/wikipedia/commons/4/44/Microsoft_logo.svg',
                'rating' => 5,
                'tragetCountries' => ['FR', 'CM', 'US'],
                'type' => 'bestRated'
            ],
            
        ];

        foreach($brands as $data){
            $brand = new Brand();
            $brand->setBrandName($data['brandName']);
            $brand->setBrandImage($data['brandImage']);
            $brand->setRating($data['rating']);
            $brand->setType($data['type']);
            $brand->setTargetCountries($data['tragetCountries']);
            $manager->persist($brand);
        }
        // $manager->persist($product);

        $manager->flush();
    }
}

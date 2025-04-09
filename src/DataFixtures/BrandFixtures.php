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
                'brandName' => 'Coca-Cola',
                'brandImage' => 'https://upload.wikimedia.org/wikipedia/commons/2/2f/Google_2015_logo.svg',
                'rating' => 4,
                'tragetCountries' => ['FR', 'CM', 'US']
            ],
            [
                'brandName' => 'Apple',
                'brandImage' => 'https://upload.wikimedia.org/wikipedia/commons/f/fa/Apple_logo_black.svg',
                'rating' => 5,
                'tragetCountries' => ['FR', 'JP', 'US']
            ],
            [
                'brandName' => 'Google',
                'brandImage' => 'https://upload.wikimedia.org/wikipedia/commons/2/2f/Google_2015_logo.svg',
                'rating' => 5,
                'tragetCountries' => ['CA', 'IN', 'US']
            ],
            [
                'brandName' => 'Amazon',
                'brandImage' => 'https://upload.wikimedia.org/wikipedia/commons/a/a9/Amazon_logo.svg',
                'rating' => 5,
                'tragetCountries' => ['DE', 'IN', 'UK']
            ],
           /* [
                'brandName' => 'Orange',
                'brandImage' => '',
                'rating' => 2,
                'tragetCountries' => ['SN', 'CM', 'FR']
            ],
            [
                'brandName' => 'Samsung',
                'brandImage' => '',
                'rating' => 3,
                'tragetCountries' => ['KR', 'RU', 'IN']
            ],
            [
                'brandName' => 'Toyota',
                'brandImage' => '',
                'rating' => 4,
                'tragetCountries' => ['JP', 'JP', 'US']
            ],
            [
                'brandName' => 'Microsoft',
                'brandImage' => '',
                'rating' => 5,
                'tragetCountries' => ['FR', 'CA', 'US']
            ],
            [
                'brandName' => 'MtN',
                'brandImage' => '',
                'rating' => 3,
                'tragetCountries' => ['GH', 'CM', 'NR']
            ],
            [
                'brandName' => 'Mercedes-Benz',
                'brandImage' => '',
                'rating' => 2,
                'tragetCountries' => ['FR', 'DE', 'IT']
            ],*/
            
        ];

        foreach($brands as $data){
            $brand = new Brand();
            $brand->setBrandName($data['brandName']);
            $brand->setBrandImage($data['brandImage']);
            $brand->setRating($data['rating']);
            $brand->setTargetCountries($data['tragetCountries']);
            $manager->persist($brand);
        }
        // $manager->persist($product);

        $manager->flush();
    }
}

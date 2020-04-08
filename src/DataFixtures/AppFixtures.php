<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Categories;
use App\Entity\Produit;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
      $faker = Faker\Factory::create('fr_FR');

      $categories = [];

        for ($i = 0; $i < 20; $i++) {
            $category = new Categories();
            $category->setNom($faker->word());

            $manager->persist($category);
            $categories[] = $category;
        }

      for ($j = 0; $j < 30; $j++) {
        $product = new Produit();
        $product->setNom($faker->word())
            ->setDescription($faker->word())
            ->setPrix($faker->numberBetween(5, 50))
            ->addCategory($categories[$faker->numberBetween(0, count($categories) - 1)]);

        $manager->persist($product);

      }

        $manager->flush();
    }
}

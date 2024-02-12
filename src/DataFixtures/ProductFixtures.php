<?php
// src/DataFixtures/ProductFixtures.php
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Product;
use App\Entity\Category;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $categories = $manager->getRepository(Category::class)->findAll();

        for ($i = 1; $i <= 20; $i++) {
            $product = new Product();
            $product->setName('Produit ' . $i);
            $product->setDescription('Produit ' . $i);
            $product->setPrice(rand(10, 100)); // Prix aléatoire

            // Sélectionnez une catégorie aléatoire parmi les catégories existantes
            $randomCategory = $categories[array_rand($categories)];
            $product->setCategory($randomCategory);

            $manager->persist($product);
        }

        $manager->flush();
    }
}

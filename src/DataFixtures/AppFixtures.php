<?php

namespace App\DataFixtures;

use DateTime;
use Faker\Factory;
use App\Entity\Step;
use App\Entity\Unit;
use App\Entity\User;
use DateTimeImmutable;
use App\Entity\Comment;
use App\Entity\Category;
use App\Entity\Cocktail;
use App\Entity\Material;
use App\Entity\Ingredient;
use Cocur\Slugify\Slugify;
use App\Entity\CocktailUse;
use App\Entity\TypeMaterial;
use App\Entity\TypeIngredient;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\Provider\AppProvider;
use Symfony\Component\VarDumper\VarDumper;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{


    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {

        // creation of the faker
        $faker = Factory::create("fr_FR");
        $faker->addProvider(new AppProvider());


        // ! TYPE MATERIAL
        $typeMaterialList = [];

        for ($i = 1; $i < 6; $i++) {
            $TypeMaterial = new TypeMaterial();
            $TypeMaterial->setName('typeMaterial' . $i);
            $typeMaterialList[] = $TypeMaterial;
            $manager->persist($TypeMaterial);
        }


        // ! TYPE INGREDIENT
        $typeIngredientList = [];
        for ($i = 1; $i < 6; $i++) {
            $TypeIngredient = new TypeIngredient();
            $TypeIngredient->setName('typeIngredient' . $i);
            $typeIngredientList[] = $TypeIngredient;
            $manager->persist($TypeIngredient);
        }

        // ! CATEGORY    

        $categoryList = [];
        for ($i = 1; $i < 6; $i++) {
            $slugify = new Slugify();
            $categoryName = $faker->words(3, true);
            $category = new Category($categoryName);
            $category->setName($categoryName);
            $category->setSlug($slugify->slugify($categoryName));
            $categoryList[] = $category;
            $manager->persist($category);
        }

        // ! UNIT

        $unitList = [];
        for ($i = 1; $i < 6; $i++) {
            $unit = new Unit();
            $unit->setName('unit' . $i);
            $unitList[] = $unit;
            $manager->persist($unit);
        }

        // ! USER
        $userList = [];
        for ($i = 1; $i < 24; $i++) {
            $dataUser = $faker->unique()->user();
            $user = new User();
            $user->setEmail($dataUser["email"]);
            $user->setRoles($dataUser["roles"]);
            $user->setPassword($this->passwordHasher->hashPassword($user, $dataUser["password"]));
            $user->setFirstname($faker->firstName());
            $user->setLastname($faker->lastName());
            $user->setPseudonym($faker->userName());
            $user->setDateOfBirth(new DateTimeImmutable($faker->date()));
            $user->setCreatedAt(new \DateTimeImmutable());
            $user->setLastLogin(new DateTimeImmutable($faker->date()));
            $user->setVerified(mt_rand(0, 1));
            $user->setIpAdress($faker->ipv4());
            $user->setWarning(mt_rand(0, 10));
            $user->setPicture("https://picsum.photos/id/" . mt_rand(50, 120) . "/768/1024");

            $userList[] = $user;

            $manager->persist($user);
        }


        // ! INGREDIENT

        $ingredientList = [];
        for ($i = 1; $i < 6; $i++) {
            $ingredient = new Ingredient();
            $ingredient->setName('ingredient' . $i);
            $ingredient->setTypeingredient($typeIngredientList[array_rand($typeIngredientList)]);
            $ingredientList[] = $ingredient;
            $manager->persist($ingredient);
        }

        // ! MATERIAL

        $materialList = [];
        for ($i = 1; $i < 6; $i++) {
            $material = new Material();
            $material->setName('material' . $i);
            $material->setTypematerial($typeMaterialList[array_rand($typeMaterialList)]);
            $materialList[] = $material;
            $manager->persist($material);
        }

        // ! COCKTAIL
        for ($i = 1; $i < 40; $i++) {
            $cocktailUnique = [];
            $cocktail = new Cocktail();
            $cocktailName = $faker->words(3, true);
            $cocktail->setName($cocktailName);
            $cocktail->setDescription($faker->paragraph());
            $cocktail->setPicture("https://picsum.photos/id/" . mt_rand(50, 120) . "/768/1024");
            $cocktail->setDifficulty(mt_rand(1, 3));
            $cocktail->setVisible(1);
            $cocktail->setPreparationTime(mt_rand(3, 15));
            $randomNumber = mt_rand(0, 1);
            if ($randomNumber) {
                $cocktail->setTrick($faker->paragraph());
            }
            $cocktail->setAlcool(mt_rand(0, 1));
            $cocktail->setSlug($slugify->slugify($cocktailName));
            $cocktail->setRating($faker->randomFloat(1, 1, 5));
            $cocktail->setUser($userList[array_rand($userList)]);
            $randomIndexArrayMaterial = array_rand($materialList, 3);
            for ($j = 0; $j < mt_rand(0, 3); $j++) { 
                $cocktail->addMaterial($materialList[$randomIndexArrayMaterial[$j]]);
            }

            // I store the cocktail at each turn of the loop
            $cocktailUnique[] = $cocktail;
            // I take 4 random indexes in my table of ingredients
            $randomindexIngredient = array_rand($ingredientList, 3);


            // I loop to randomly add 1 to 4 cocktails use per cocktail ( quantity, unit, ingredient, cocktail )
            for ($k = 0; $k < mt_rand(1, 3); $k++) { 
                $cocktailUse = new CocktailUse();
                // I send my cocktail in the cocktail_use table using the index of my array ($cocktailUnique)
                $cocktailUse->setCocktail($cocktailUnique[0]);
                // I set a random quantity for my ingredients
                $cocktailUse->setQuantity(mt_rand(1,10));
                // I define a unit of measurement by searching randomly in my unit array
                $cocktailUse->setUnit($unitList[array_rand($unitList)]);
                //I link an ingredient from my random array to my cocktail use
                $cocktailUse->setIngredient($ingredientList[$randomindexIngredient[$k]]);
                $manager->persist($cocktailUse);
            }

            $randomindexCategory = array_rand($categoryList, 2);
            for ($l = 0; $l < mt_rand(1, 2); $l++) {
                $cocktail->addCategory($categoryList[$randomindexCategory[$l]]);
            }

            for ($l = 0; $l < mt_rand(2, 5); $l++) {
                $comment = new Comment();
                $comment->setContent($faker->paragraph());
                $comment->setRating(mt_rand(1,5));
                $comment->setPostedAt(new \DateTimeImmutable());
                $comment->setCocktail($cocktailUnique[0]);
                $comment->setUser($userList[array_rand($userList)]);

                $manager->persist($comment);
            }

            for ($m = 1; $m < mt_rand(1, 6); $m++) {
                $step = new Step();
                $step->setNumberStep($m);
                $step->setContent($faker->paragraph());
                $step->setCocktail($cocktailUnique[0]);
                $manager->persist($step);
            }
            

            $manager->persist($cocktail);
        }

        $manager->flush();
    }
}

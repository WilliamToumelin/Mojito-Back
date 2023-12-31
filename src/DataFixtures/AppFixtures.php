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
use App\Entity\Ingredient;
use Cocur\Slugify\Slugify;
use App\Entity\CocktailUse;
use App\Entity\TypeIngredient;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\Provider\AppProvider;
use App\Entity\Glass;
use App\Entity\Ice;
use App\Entity\Rating;
use App\Entity\Technical;
use Symfony\Component\VarDumper\VarDumper;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\DBAL\Cache\ArrayResult;
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


        // ! ICE
        // I create my different ices

        $iceList = [];

        for ($i = 1; $i < 6; $i++) {
            $ice = new Ice();
            $ice->setName('Ice' . $i);
            $iceList[] = $ice;
            $manager->persist($ice);
        }

         // ! GLASS
        // I create my different ices

        $glassList = [];

        for ($i = 1; $i < 6; $i++) {
            $glass = new Glass();
            $glass->setName('Glass' . $i);
            $glassList[] = $glass;
            $manager->persist($glass);
        }

         // ! TECHNICAL
        // I create my different ices

        $technicalList = [];

        for ($i = 1; $i < 4; $i++) {
            $technical = new Technical();
            $technical->setName($faker->unique()->technical());
            $technicalList[] = $technical;
            $manager->persist($technical);
        }


        // ! TYPE INGREDIENT
        // I create my different types of ingredients

        $typeIngredientList = [];
        for ($i = 1; $i < 4; $i++) {
            $TypeIngredient = new TypeIngredient();
            $TypeIngredient->setName($faker->unique()->typeIngredient());
            $typeIngredientList[] = $TypeIngredient;
            $manager->persist($TypeIngredient);
        }

        // ! CATEGORY    
        // I create my different categories

        $categoryList = [];
        for ($i = 1; $i < 12; $i++) {
            $slugify = new Slugify();
            $categoryName = $faker->unique()->category();
            $category = new Category($categoryName);
            $category->setName($categoryName);
            $category->setSlug($slugify->slugify($categoryName));
            $categoryList[] = $category;
            $manager->persist($category);
        }

        // ! UNIT
        // I create my different units

        $unitList = [];
        for ($i = 1; $i < 6; $i++) {
            $unit = new Unit();
            $unit->setName($faker->unique()->unit());
            $unitList[] = $unit;
            $manager->persist($unit);
        }

        // ! USER
        // I create my different users

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
            $user->setWarning(mt_rand(0, 10));
            $user->setPicture("https://picsum.photos/id/" . mt_rand(50, 120) . "/768/1024");

            $userList[] = $user;

            $manager->persist($user);
        }


        // ! INGREDIENT
        // I create my different ingredients

        $ingredientList = [];
        for ($i = 1; $i < 15; $i++) {
            $ingredient = new Ingredient();
            $ingredient->setName($faker->unique()->ingredient());
            $ingredient->setTypeingredient($typeIngredientList[array_rand($typeIngredientList)]);
            $ingredientList[] = $ingredient;
            $manager->persist($ingredient);
        }

        // ! COCKTAIL
        // I create my different cocktails

        for ($i = 1; $i < 25; $i++) {
            $cocktailUnique = [];
            $cocktail = new Cocktail();
            $dataCocktail = $faker->unique()->cocktail();
            $cocktailName = $dataCocktail["name"];
            $cocktail->setName($cocktailName);
            $cocktail->setDescription($faker->paragraph());
            $cocktail->setPicture($dataCocktail["image"]);
            $cocktail->setDifficulty(mt_rand(1, 3));
            $cocktail->setVisible(1);
            $cocktail->setPreparationTime(mt_rand(3, 15));
            $randomNumber = mt_rand(0, 1);
            if ($randomNumber) {
                $cocktail->setTrick($faker->paragraph());
            }
            $cocktail->setAlcool(mt_rand(0, 1));
            $cocktail->setSlug($slugify->slugify($cocktailName));
            $cocktail->setUser($userList[array_rand($userList)]);
            $cocktail->setIce($iceList[array_rand($iceList)]);
            $cocktail->setGlass($glassList[array_rand($glassList)]);
            $cocktail->setTechnical($technicalList[array_rand($technicalList)]);
            

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
                $cocktailUse->setQuantity(mt_rand(1, 10));
                // I define a unit of measurement by searching randomly in my unit array
                $cocktailUse->setUnit($unitList[array_rand($unitList)]);
                //I link an ingredient from my random array to my cocktail use
                $cocktailUse->setIngredient($ingredientList[$randomindexIngredient[$k]]);
                $manager->persist($cocktailUse);
            }
            // I get two random indexes in my category list
            $randomindexCategory = array_rand($categoryList, 2);
            // I randomly add 1 to 2 categories to my cocktail
            for ($l = 0; $l < mt_rand(1, 2); $l++) {
                $cocktail->addCategory($categoryList[$randomindexCategory[$l]]);
            }

            // ! COMMENT 
            // I create my different comments for each cocktail (Daiquiri, mojito, etc ...)
            // I randomly add 1 to 5 comments per cocktail
            for ($l = 0; $l < mt_rand(1, 5); $l++) {
                $comment = new Comment();
                $comment->setContent($faker->paragraph());
                $comment->setPostedAt(new \DateTimeImmutable());
                $comment->setCocktail($cocktailUnique[0]);
                $comment->setUser($userList[array_rand($userList)]);

                $manager->persist($comment);
            }

            // ! RATING 
            
            for ($l = 0; $l < mt_rand(1, 10); $l++) {
                $rating = new Rating();
                $rating->setRating(mt_rand(1,5));
                $rating->setCocktail($cocktailUnique[0]);
                $rating->setUser($userList[array_rand($userList)]);
            

                $manager->persist($rating);
            }

            // ! STEP
            // I create my different steps for each cocktail (step 1, step2, etc ...)

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

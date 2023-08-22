<?php

namespace App\DataFixtures;

use App\DataFixtures\Provider\AppProvider;
use Faker\Factory;
use App\Entity\Unit;
use App\Entity\Category;
use App\Entity\Cocktail;
use App\Entity\CocktailUse;
use App\Entity\Ingredient;
use App\Entity\Material;
use App\Entity\TypeMaterial;
use App\Entity\TypeIngredient;
use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\VarDumper\VarDumper;

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
        //!!!!!!!!!!!!!! FAIRE SLUG !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!//

        $categoryList = [];
        for ($i = 1; $i < 6; $i++) {
            $category = new Category();
            $category->setName('category' . $i);
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
        for ($i = 1; $i < 4; $i++) {
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
            $user->setPicture($faker->imageUrl(640, 480, 'animals', true));

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
        for ($i = 1; $i < 6; $i++) {
            $cocktailUnique = [];
            $cocktail = new Cocktail();
            $cocktail->setName($faker->word());
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
            $cocktail->setSlug($faker->slug());
            $cocktail->setRating($faker->randomFloat(1, 1, 5));
            $cocktail->setUser($userList[array_rand($userList)]);
            $randomIndexArrayMaterial = array_rand($materialList, 3);
            for ($j = 0; $j < mt_rand(0, 3); $j++) { 
                $cocktail->addMaterial($materialList[$randomIndexArrayMaterial[$j]]);
            }

            $cocktailUnique[] = $cocktail;


            for ($k = 0; $k < mt_rand(1, 3); $k++) { 
                $cocktailUse = new CocktailUse();
                $cocktailUse->setCocktail($cocktailUnique[0]);
                $cocktailUse->setQuantity(mt_rand(1,10));
                $cocktailUse->setUnit($unitList[array_rand($unitList)]);
                $cocktailUse->setIngredient($ingredientList[array_rand($ingredientList)]);
                $manager->persist($cocktailUse);
            }
            $manager->persist($cocktail);
        }

        $manager->flush();
    }
}

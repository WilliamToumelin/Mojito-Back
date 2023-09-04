<?php

namespace App\Controller\Api;

use App\Entity\Cocktail;
use App\Repository\CocktailRepository;
use App\Repository\IngredientRepository;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Node\Expr\New_;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;


class CocktailController extends AbstractController
{
    /**
     * @Route("/api/cocktails", name="app_api_cocktails_getCocktails", methods={"GET"})
     */
    public function getCocktails(CocktailRepository $cocktailRepository): JsonResponse
    {

        $cocktails = $cocktailRepository->findAllCocktailByVisible();


        return $this->json($cocktails, Response::HTTP_OK, [], ["groups" => "cocktailsBasicInfo"]);
    }

    /**
     * @Route("/api/cocktails/{id}", name="app_api_cocktails_getCocktailsById",requirements={"id"="\d+"}, methods={"GET"})
     */
    public function getCocktailsById(Cocktail $cocktail): JsonResponse
    {
        return $this->json($cocktail, Response::HTTP_OK, [], ["groups" => "cocktailsAllInfo"]);
    }


    /**
     * @Route("/api/cocktails/{id}/comments", name="app_api_cocktails_getCocktailsComments",requirements={"id"="\d+"}, methods={"GET"})
     */
    public function getCocktailsCommentsById(Cocktail $cocktail): JsonResponse
    {
        return $this->json($cocktail, Response::HTTP_OK, [], ["groups" => "comments"]);
    }



    /**
     * @Route("/api/cocktails/add", name="app_api_cocktails_add", methods={"POST"})
     */
    public function add(Request $request, SerializerInterface $serializer, ValidatorInterface $validator, EntityManagerInterface $entityManager, TokenStorageInterface $tokenStorage, SluggerInterface $slugger, IngredientRepository $ingredientRepository): JsonResponse
    {

        // return null if token doesn't exist
        if ($tokenStorage->getToken() == null) {
            return null;
        }

        // I retrieve the user 
        $user = $tokenStorage->getToken()->getUser();

        // I retrieve a raw json
        $jsonContent = $request->getContent();


        // I transform this json into a user entity and handle the case of a possible json format error
        // if I find an error I return a json error
        try {
            $cocktail = $serializer->deserialize($jsonContent, Cocktail::class, 'json');
        } catch (NotEncodableValueException $e) {
            return $this->json(["error" => "JSON INVALID"], Response::HTTP_BAD_REQUEST);
        }


        // I slugify the name
        $cocktail->setSlug($slugger->slug($cocktail->getName()));


        // I associate the user with the cocktail
        $cocktail->setUser($user);


        // I get the list of CocktailUse entities 
        // then I associate the cocktail with each CocktailUse entity
        // $cocktailUsesList = $cocktail->getCocktailUses();

        // foreach ($cocktailUsesList as $cocktailUse) {
            
        //     $entityManager->persist($cocktailUse);
        //     $entityManager->persist($cocktailUse->getIngredient());
        //     $entityManager->persist($cocktailUse->getUnit());
        //     $entityManager->persist($cocktailUse->getIngredient()->getTypeingredient());
        // }


        // // I retrieve all steps entities
        // $stepList = $cocktail->getSteps();

        // // I persist each step entity
        // foreach ($stepList as $step) {
        //     $entityManager->persist($step);
        // }
        // // I persist glass entity
        // $entityManager->persist($cocktail->getGlass());
        // $entityManager->persist($cocktail->getTechnical());
        // $entityManager->persist($cocktail->getIce());


        // I detect asserts errors on my entity before persisting it
        $errors = $validator->validate($cocktail);

        // if assert errors i return a json with errors
        if (count($errors) > 0) {

            // I create a new error table
            $dataErrors = [];

            foreach ($errors as $error) {
                // I inject into the array, at the input index, the error messages concerning the error in question
                $dataErrors[$error->getPropertyPath()][] = $error->getMessage();
            }

            // I return the json with my errors
            return $this->json($dataErrors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }


        // I persist and flush
        $entityManager->persist($cocktail);

        $entityManager->flush();

        // I return created json response
        return $this->json([$cocktail], Response::HTTP_CREATED, [], ["groups" => "user"]);
    }
}

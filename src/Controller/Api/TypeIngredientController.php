<?php

namespace App\Controller\Api;

use App\Entity\TypeIngredient;
use App\Repository\TypeIngredientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TypeIngredientController extends AbstractController
{
    /**
     * @Route("/api/typeingredients/{name}/ingredients", name="app_api_typeIngredients_getIngredientsByTypeId", methods={"GET"})
     */
    public function getIngredientsByTypeId(TypeIngredientRepository $typeIngredientRepository, $name): JsonResponse
    {

        $typeIngredients = $typeIngredientRepository->findBy(array('name' => $name));
        
        if(($typeIngredients === [])){
            return $this->json(['error' => 'Ingredient type does not exist'], Response::HTTP_NOT_FOUND);
        }

        return $this->json($typeIngredients, Response::HTTP_OK, [], ["groups" => "typeingredientsWithRelations"]);
    }


    /**
     * @Route("/api/typeingredients/ingredients", name="app_api_typeIngredients_getTypeIngredients")
     */
    public function getTypeIngredients(TypeIngredientRepository $typeIngredientRepository): JsonResponse
    {
        $typeIngredients = $typeIngredientRepository->findAll();


        return $this->json($typeIngredients, Response::HTTP_OK, [], ["groups" => "typeingredientsWithRelations"]);
    }
}

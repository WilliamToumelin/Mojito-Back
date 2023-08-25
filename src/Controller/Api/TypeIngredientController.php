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
     * @Route("/api/typeingredients/ingredients", name="app_api_typeIngredients_getTypeIngredients")
     */
    public function getTypeIngredients(TypeIngredientRepository $typeIngreRepository): JsonResponse
    {
        $ices = $typeIngreRepository->findAll();


        return $this->json($ices, Response::HTTP_OK, [], ["groups" => "typeingredientsWithRelations"]);
    }
}

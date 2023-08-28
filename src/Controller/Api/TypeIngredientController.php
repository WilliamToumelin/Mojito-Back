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
     * @Route("/api/typeingredients/{id}/ingredients", name="app_api_typeIngredients_getIngredientsByTypeId",requirements={"id"="\d+"}, methods={"GET"})
     */
    public function getIngredientsByTypeId(TypeIngredient $typeIngredient): JsonResponse
    {

        return $this->json($typeIngredient, Response::HTTP_OK, [], ["groups" => "typeingredientsWithRelations"]);
    }
}

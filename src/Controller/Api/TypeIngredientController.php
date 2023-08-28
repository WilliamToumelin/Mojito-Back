<?php

namespace App\Controller\Api;

use App\Entity\TypeIngredient;
use App\Repository\GlassRepository;
use App\Repository\IceRepository;
use App\Repository\TechnicalRepository;
use App\Repository\TypeIngredientRepository;
use App\Repository\UnitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TypeIngredientController extends AbstractController
{


    /**
     * @Route("/api/typeingredients/ingredients", name="app_api_typeIngredients_getTypeIngredients", methods={"GET"})
     */
    public function getTypeIngredients(TypeIngredientRepository $typeIngredientRepository): JsonResponse
    {
        $typeIngredients = $typeIngredientRepository->findAll();


        return $this->json($typeIngredients, Response::HTTP_OK, [], ["groups" => "typeingredientsWithRelations"]);
    }


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
     * @Route("/api/propositions/data", name="app_api_typeIngredients_getPropositionsData", methods={"GET"})
     */
    public function getPropositionsData(TypeIngredientRepository $typeIngredientRepository, GlassRepository $glassRepository, IceRepository $iceRepository, TechnicalRepository $technicalRepository, UnitRepository $unitRepository): JsonResponse
    {
        $typeIngredients['ingredients'] = $typeIngredientRepository->findAll();
        $typeIngredients['glass'] = $glassRepository->findAll();
        $typeIngredients['ices'] = $iceRepository->findAll();
        $typeIngredients['technicals'] = $technicalRepository->findAll();
        $typeIngredients['units'] = $unitRepository->findAll();


        return $this->json($typeIngredients, Response::HTTP_OK, [], ["groups" => "propositionsData"]);
    }
}

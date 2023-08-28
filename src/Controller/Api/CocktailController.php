<?php

namespace App\Controller\Api;

use App\Entity\Cocktail;
use App\Repository\CocktailRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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

    
}

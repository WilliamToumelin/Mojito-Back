<?php

namespace App\Controller\Api;

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

        $cocktails = $cocktailRepository->findAllCocktailByVisible(true);


        return $this->json($cocktails, Response::HTTP_OK, [], ["groups" => "cocktailsWithRelations"]);
    }


    /**
     * @Route("/api/cocktails/comments", name="app_api_cocktails_getCocktailsComments", methods={"GET"})
     */
    public function getCocktailsComments(CocktailRepository $cocktailRepository): JsonResponse
    {

        $cocktails = $cocktailRepository->findAll();


        return $this->json($cocktails, Response::HTTP_OK, [], ["groups" => "comments"]);
    }

    
}

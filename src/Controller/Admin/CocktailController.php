<?php

namespace App\Controller\Admin;

use App\Entity\Cocktail;
use App\Repository\CocktailRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CocktailController extends AbstractController
{
    /**
     * Display all cocktails
     * @Route("/admin/cocktails", name="app_cocktail_list")
     */
    public function list(CocktailRepository $cocktailRepository, Request $request): Response
    {
        return $this->render('cocktail/list.html.twig', [
            'cocktails' => $cocktailRepository->paginatorForCocktailsList($request->query->getInt('page', 1)),
        ]);
    }

    /**
     * Display one cocktail 
     * @Route("/admin/cocktail/{id}", name="app_cocktail_show", requirements={"id"="\d+"})
     */
    public function show(CocktailRepository $cocktailRepository, Cocktail $cocktail): Response
    {
        $cocktail = $cocktailRepository->find($cocktail);
        
        return $this->render(
        'cocktail/show.html.twig', ['cocktail' => $cocktail]);
    }
}

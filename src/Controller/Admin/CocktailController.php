<?php

namespace App\Controller\Admin;

use App\Entity\Cocktail;
use App\Repository\CocktailRepository;
use PhpParser\Node\Stmt\Foreach_;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class CocktailController extends AbstractController
{
    /**
     * Display all cocktails
     * @Route("/admin/cocktails", name="app_cocktail_list")
     */
    public function list(CocktailRepository $cocktailRepository): Response
    {
        return $this->render('cocktail/list.html.twig', [
            'cocktails' => $cocktailRepository->findAll(),
        ]);
    }

    /**
     * Display one cocktail 
     * @Route("/admin/cocktails/{id}", name="app_cocktail_show")
     */
    public function show(CocktailRepository $cocktailRepository, Cocktail $cocktail): Response
    {
        $cocktail = $cocktailRepository->find($cocktail);
        
        return $this->render(
        'cocktail/show.html.twig', ['cocktail' => $cocktail]);
    }
}

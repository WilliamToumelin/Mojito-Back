<?php

namespace App\Controller\Admin;

use App\Repository\CocktailRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


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
}

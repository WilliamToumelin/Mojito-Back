<?php

namespace App\Controller\Admin;

use App\Repository\CocktailRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CocktailController extends AbstractController
{
    /**
     * List all cocktails
     * @Route("/admin/home", name="app_admin_home")
     */
    public function index(CocktailRepository $cocktailRepository): Response
    {
        return $this->render('cocktail/list.html.twig', [
            'cocktails' => $cocktailRepository->findAll(),
        ]);
    }
}

<?php

namespace App\Controller\Admin;

use App\Entity\Step;
use App\Entity\Cocktail;
use App\Form\CocktailType;
use App\Repository\CocktailRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

      /**
     * add a cocktail 
     * @Route("/admin/cocktail/ajouter", name="app_movie_add", methods={"GET", "POST"})
     */

    public function add(Request $request, CocktailRepository $cocktailRepository): Response
    {
        $cocktail = new Cocktail();

        $step1 = new Step();

        



        $form = $this->createForm(CocktailType::class, $cocktail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cocktailRepository->add($cocktail, true);


            $this->addFlash("success", "Coctail enregistré");

            return $this->redirectToRoute('app_cocktail_list', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cocktail/add.html.twig', [
            'form' => $form,
        ]);
    }





}



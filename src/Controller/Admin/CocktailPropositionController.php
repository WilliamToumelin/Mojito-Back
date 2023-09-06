<?php

namespace App\Controller\Admin;

use App\Entity\Cocktail;
use App\Repository\CocktailRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CocktailPropositionController extends AbstractController
{
    /**
     * @Route("/admin/cocktails/propositions", name="app_cocktail_proposition_index", methods={"GET"})
     */
    public function index(CocktailRepository $cocktailRepository, Request $request): Response
    {
        return $this->render('cocktail_validator/index.html.twig', [
            'cocktails' => $cocktailRepository->paginatorForCocktailsList($request->query->getInt('page', 1), 0),
        ]);
    }


    /**
     * @Route("/admin/cocktail/proposition/{id}", name="app_cocktail_proposition_show", methods={"GET"})
     */
    public function show(Cocktail $cocktail): Response
    {
        return $this->render('cocktail_validator/show.html.twig', [
            'cocktail' => $cocktail,
        ]);
    }


     /**
     * @Route("/admin/cocktail/{id}/accepter", name="app_cocktail_proposition_accept", methods={"POST"})
     */
    public function add(Request $request, Cocktail $cocktail, CocktailRepository $cocktailRepository, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('accept'.$cocktail->getId(), $request->request->get('_token'))) {
            
            $cocktail->setVisible(1);
            $entityManager->persist($cocktail);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cocktail_proposition_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/admin/cocktail/{id}/refuser", name="app_cocktail_proposition_delete", methods={"POST"})
     */
    public function delete(Request $request, Cocktail $cocktail, CocktailRepository $cocktailRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cocktail->getId(), $request->request->get('_token'))) {
            $cocktailRepository->remove($cocktail, true);
        }

        return $this->redirectToRoute('app_cocktail_proposition_index', [], Response::HTTP_SEE_OTHER);
    }
}


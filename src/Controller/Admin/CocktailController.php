<?php

namespace App\Controller\Admin;

use App\Entity\Cocktail;
use App\Entity\User;
use App\Form\CocktailType;
use App\Repository\CocktailRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\UserInterface;

class CocktailController extends AbstractController
{
    /**
     * Display all cocktails
     * @Route("/admin/cocktails", name="app_cocktail_index")
     */
    public function index(CocktailRepository $cocktailRepository, Request $request): Response
    {

        return $this->render('cocktail/index.html.twig', [
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
            'cocktail/show.html.twig',
            ['cocktail' => $cocktail]
        );
    }

    /**
     * add a cocktail 
     * @Route("/admin/cocktail/ajouter", name="app_cocktail_new", methods={"GET", "POST"})
     */

    public function new(Request $request, CocktailRepository $cocktailRepository, UserRepository $userRepository, EntityManagerInterface $entityManager, UserInterface $userInterface): Response
    {
        $cocktail = new Cocktail();

        $form = $this->createForm(CocktailType::class, $cocktail);
        $errors = [];

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $cocktail->setUser($userInterface);
            
            if(count($cocktail->getSteps()) === 0) {
                $errors[] = 'Au moins une étape est nécessaire';
            }

            if(count($cocktail->getCocktailUses()) === 0) {
                $errors[] = 'Au moins un ingrédient est nécessaire';
            }

            if(count($errors) > 0) {
                return $this->renderForm('cocktail/new.html.twig', [
                    'form' => $form,
                    'errors' => $errors,
                ]);
            }

            
            $cocktailRepository->add($cocktail, true);


            $this->addFlash("success", "Cocktail mis à jour");

            return $this->redirectToRoute('app_cocktail_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cocktail/new.html.twig', [
            'form' => $form,
            'errors' => $errors,
        ]);
    }


    /**
     * edit a cocktail 
     * @Route("/admin/cocktail/modifier/{id}", name="app_cocktail_edit", methods={"GET", "POST"}, requirements={"id"="\d+"})
     */

    public function edit(Cocktail $cocktail, Request $request, CocktailRepository $cocktailRepository, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CocktailType::class, $cocktail);
        $errors = [];

        // Create an ArrayCollection of the current Tag objects in the database
        foreach ($cocktail->getCocktailUses() as $cocktailuse) {

            $entityManager->remove($cocktailuse);
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cocktailRepository->add($cocktail, true);


            $this->addFlash("success", "Cocktail mis à jour");

            return $this->redirectToRoute('app_cocktail_index', ["id" => $cocktail->getId()]);
        }

        return $this->renderForm('cocktail/edit.html.twig', [
            'form' => $form,
            'errors' => $errors,
        ]);
    }

    /**
     * @Route("/admin/cocktail/supprimer/{id}", name="app_cocktail_delete", methods={"POST"})
     */
    public function delete(Request $request, Cocktail $cocktail, CocktailRepository $cocktailRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $cocktail->getId(), $request->request->get('_token'))) {
            $cocktailRepository->remove($cocktail, true);
        }

        return $this->redirectToRoute('app_cocktail_index', [], Response::HTTP_SEE_OTHER);
    }
}

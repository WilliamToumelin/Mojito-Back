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
           
            // I define the number of the step automatically, so the user cannot enter the same step number
           $stepsList = $cocktail->getSteps();
            foreach ($stepsList as $key => $step) {
                $numberStep = $step->getNumberStep();
                $numberStep = $key + 1 ;
                $step->setNumberStep($numberStep);
            }


            // I associate the user and the cocktail
            $cocktail->setUser($userInterface);

            // I check if the cocktail has at least one step. If not, I return an error message
            if(count($cocktail->getSteps()) === 0) {
                $errors[] = 'Au moins une étape est nécessaire';
            }

            // I retrieve all the cocktailUses;
            $cocktailUsesList = $cocktail->getCocktailUses();

            // I check if the cocktail has at least one ingredient. If not, I return an error message
            if(count($cocktailUsesList) === 0) {
                $errors[] = 'Au moins un ingrédient est nécessaire';
            }


            // I check whether the quantity of an ingredient is greater than 0. If not, I return an error message
           foreach ($cocktailUsesList as $cocktailUses) {
           $quantity = $cocktailUses->getQuantity();
           $ingredient = $cocktailUses->getIngredient()->getName();
            if($quantity <= 0) {
                $errors[] = "La quantité de l'ingrédient $ingredient ne peut pas être inférieure à 0";
            }
           }

            // If there are any errors, I stop sending the form and display them
            if(count($errors) > 0) {
                return $this->renderForm('cocktail/new.html.twig', [
                    'form' => $form,
                    'errors' => $errors,
                ]);
            }

            // I persist and flush the cocktail
            $cocktailRepository->add($cocktail, true);

            // I redirect the user to the cocktail index page and i display a success message
            $this->addFlash("success", "Cocktail ajouté");

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

    public function edit(Cocktail $cocktail, Request $request, CocktailRepository $cocktailRepository, EntityManagerInterface $entityManager, UserInterface $userInterface): Response
    {   
        $form = $this->createForm(CocktailType::class, $cocktail);
        $errors = [];

        // Create an ArrayCollection of the current Tag objects in the database
        foreach ($cocktail->getCocktailUses() as $cocktailuse) {

            $entityManager->remove($cocktailuse);
        }

        // Create an ArrayCollection of the current Tag objects in the database
        foreach ($cocktail->getSteps() as $step) {

            $entityManager->remove($step);
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // I define the number of the step automatically, so the user cannot enter the same step number
           $stepsList = $cocktail->getSteps();
           foreach ($stepsList as $key => $step) {
               $numberStep = $step->getNumberStep();
               $numberStep = $key + 1 ;
               $step->setNumberStep($numberStep);
           }

           // I associate the user and the cocktail
            $cocktail->setUser($userInterface);

            // I check if the cocktail has at least one step. If not, I return an error message
            if(count($cocktail->getSteps()) === 0) {
                $errors[] = 'Au moins une étape est nécessaire';
            }

            // I retrieve all the cocktailUses;
            $cocktailUsesList = $cocktail->getCocktailUses();

            // I check if the cocktail has at least one ingredient. If not, I return an error message
            if(count($cocktailUsesList) === 0) {
                $errors[] = 'Au moins un ingrédient est nécessaire';
            }

            // I check whether the quantity of an ingredient is greater than 0. If not, I return an error message
           foreach ($cocktailUsesList as $cocktailUses) {
           $quantity = $cocktailUses->getQuantity();
           $ingredient = $cocktailUses->getIngredient()->getName();
            if($quantity <= 0) {
                $errors[] = "La quantité de l'ingrédient $ingredient ne peut pas être inférieure à 0";
            }
           }

            // If there are any errors, I stop sending the form and display them
            if(count($errors) > 0) {
                return $this->renderForm('cocktail/new.html.twig', [
                    'form' => $form,
                    'errors' => $errors,
                ]);
            }

             // I persist and flush the cocktail
            $cocktailRepository->add($cocktail, true);

             // I redirect the user to the cocktail index page and i display a success message
            $this->addFlash("success", "Cocktail mis à jour");

            return $this->redirectToRoute('app_cocktail_index', ["id" => $cocktail->getId()]);
        }

        return $this->renderForm('cocktail/edit.html.twig', [
            'form' => $form,
            'errors' => $errors,
        ]);
    }

    /**
     * delete a cocktail
     * @Route("/admin/cocktail/supprimer/{id}", name="app_cocktail_delete", methods={"POST"})
     */
    public function delete(Request $request, Cocktail $cocktail, CocktailRepository $cocktailRepository): Response
    {   

        //crsf protection: if the token is valid, I delete the cocktail and redirect the user to the cocktail index page
        if ($this->isCsrfTokenValid('delete' . $cocktail->getId(), $request->request->get('_token'))) {
            $cocktailRepository->remove($cocktail, true);
        }

        return $this->redirectToRoute('app_cocktail_index', [], Response::HTTP_SEE_OTHER);
    }
}

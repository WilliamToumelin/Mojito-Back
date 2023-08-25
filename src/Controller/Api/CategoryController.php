<?php

namespace App\Controller\Api;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/api/categories", name="app_api_categories_getCategories", methods={"GET"})
     */
    public function getCategories(CategoryRepository $categoryRepository): JsonResponse
    {

        $categories = $categoryRepository->findAll();

        return $this->json($categories, Response::HTTP_OK, [], ["groups" => "categories"]);
    }
}

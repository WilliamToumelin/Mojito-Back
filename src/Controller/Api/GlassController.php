<?php

namespace App\Controller\Api;

use App\Repository\GlassRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GlassController extends AbstractController
{
    /**
     * @Route("/api/glass", name="app_api_glass_getGlass", methods={"GET"})
     */
    public function getGlass(GlassRepository $glassRepository): JsonResponse
    {

        $glass = $glassRepository->findAll();

        return $this->json($glass, Response::HTTP_OK, [], ["groups" => "glass"]);
    }
}

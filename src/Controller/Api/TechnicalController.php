<?php

namespace App\Controller\Api;

use App\Repository\TechnicalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TechnicalController extends AbstractController
{
    /**
     * @Route("/api/technicals", name="app_api_technicals_getTechnicals", methods={"GET"})
     */
    public function getTechnicals(TechnicalRepository $technicalRepository): JsonResponse
    {
        $technicals = $technicalRepository->findAll();

        return $this->json($technicals, Response::HTTP_OK, [], ["groups" => "technicals"]);
    }
}

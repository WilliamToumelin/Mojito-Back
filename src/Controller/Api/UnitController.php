<?php

namespace App\Controller\Api;

use App\Repository\UnitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UnitController extends AbstractController
{
    /**
     * @Route("/api/units", name="app_api_units_getUnits")
     */
    public function getUnits(UnitRepository $unitRepository): JsonResponse
    {
        $units = $unitRepository->findAll();

        return $this->json($units, Response::HTTP_OK, [], ["groups" => "units"]);
    }
}
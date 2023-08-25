<?php

namespace App\Controller\Api;

use App\Entity\Ice;
use App\Repository\IceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IceController extends AbstractController
{
    /**
     * @Route("/api/ices", name="app_api_ices_getIces")
     */
    public function getIces(IceRepository $iceRepository): JsonResponse
    {
        $ices = $iceRepository->findAll();


        return $this->json($ices, Response::HTTP_OK, [], ["groups" => "ices"]);
    }
}

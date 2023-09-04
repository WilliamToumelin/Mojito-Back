<?php

namespace App\Controller\Api;

use App\Entity\Comment;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;


class CommentController extends AbstractController
{
    /**
     * @Route("/api/comments/add", name="app_api_comments_add", methods={"POST"})
     */
    public function add(Request $request, SerializerInterface $serializer, ValidatorInterface $validator, EntityManagerInterface $entityManager, CommentRepository $commentRepository): JsonResponse
    {

        // I retrieve a raw json
        $jsonContent = $request->getContent();

        // I transform this json into a comment entity and handle the case of a possible json format error
        // if I find an error I return a json error
        try {
            $comment = $serializer->deserialize($jsonContent, Comment::class, 'json');
        } catch (NotEncodableValueException $e) {
            return $this->json(["error" => "JSON INVALID"], Response::HTTP_BAD_REQUEST);
        }

        //! A user cannot rate the same cocktail more than once

        // I retrieve the user ID
        $userId = $comment->getUser()->getId();

        
        // I retrieve the cocktail ID
        $cocktailId = $comment->getCocktail()->getId();
       

        // I search the database for a note with the user ID and the cocktail ID
        $ratingInDatabase = $commentRepository->findOneBy([
            'cocktail' => $cocktailId,
            'user' => $userId
        ]);

        // if so, I return a json error
        if ($ratingInDatabase) {
            return $this->json(["error" => "IMPOSSIBLE DE COMMENTER PLUSIEURS FOIS UN COCKTAIL"], Response::HTTP_BAD_REQUEST);
        }

        // I detect asserts errors on my entity before persisting it
        $errors = $validator->validate($comment);


        // if assert errors i return a json with errors
        if (count($errors) > 0) {

            // I create a new error table
            $dataErrors = [];

            foreach ($errors as $error) {
                // I inject into the array, at the input index, the error messages concerning the error in question
                $dataErrors[$error->getPropertyPath()][] = $error->getMessage();
            }

            // I return the json with my errors
            return $this->json($dataErrors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // I persist and flush
        $entityManager->persist($comment);

        $entityManager->flush();

        // I return created json response
        return $this->json([$comment], Response::HTTP_CREATED, [], ["groups" => "comments"]);
    }
}

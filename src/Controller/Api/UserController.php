<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{

    /**
     * @Route("/api/register", name="app_api_register_postUser", methods={"POST"})
     */
    public function postUserRegister(Request $request, SerializerInterface $serializer, ValidatorInterface $validator, 
    EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): JsonResponse
    {
        // I retrieve a raw json
        $jsonContent = $request->getContent();

        // I transform this json into a user entity and handle the case of a possible json format error
        // if I find an error I return a json error
        try {
            $user = $serializer->deserialize($jsonContent, User::class, 'json');
        } catch (NotEncodableValueException $e) {
            return $this->json(["error" => "JSON INVALID"], Response::HTTP_BAD_REQUEST);
        }

        // I detect asserts errors on my entity before persisting it
        $errors = $validator->validate($user);

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

        // hash the password (based on the security.yaml config for the $user class)
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $user->getPassword()
        );
        
        $user->setPassword($hashedPassword);


        // I persist and flush
        $entityManager->persist($user);

        $entityManager->flush();

        // I return created json response
        return $this->json([$user], Response::HTTP_CREATED,);
    }
}

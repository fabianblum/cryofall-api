<?php

namespace App\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AuthController extends AbstractController
{
 public function __construct(TokenStorageInterface $storage)
 {
 }

 public function register(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        try {
            $em = $this->getDoctrine()->getManager();

            $username = $request->request->get('_username');
            $password = $request->request->get('_password');

            $user = new User($username);
            $user->setPassword($encoder->encodePassword($user, $password));
            $em->persist($user);
            $em->flush();
        }
        catch(Exception $e) {
            return new Response($e->getMessage());
        }

        return new Response(sprintf('User %s successfully created', $user->getUsername()));
    }
}
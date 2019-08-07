<?php

namespace App\Controller;

use App\Entity\ShopUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/logout", name="app_logout")
     *
     */
    public function logout() {
        throw new \Exception("Приложение сломалось, вы не должны это видеть");
    }







    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //    $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/users/generate", name="generate_test_user")
     * @param UserPasswordEncoderInterface $encoder
     * @return Response
     */

    public function generateUser(UserPasswordEncoderInterface $encoder) {
        $user = new ShopUser();
        $user->setEmail("admin@myshop.ru");
        $password = "admin";
        $user->setPassword($encoder->encodePassword($user, $password));
        $user->setRoles(array("ROLE_ADMIN_USER", "ROLE_USER"));
        $manager = $this->getDoctrine()->getManager();
        $manager->persist($user);
        $manager->flush();

        return new Response("Мы создали пользователя");


    }

}

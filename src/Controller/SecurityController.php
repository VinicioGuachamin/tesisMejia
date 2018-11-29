<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use Symfony\Component\HttpFoundation\JsonResponse;

class SecurityController extends AbstractController
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
       $this->encoder = $encoder;
    }

    /**
     * @Route("/", name="login")
     */
    public function login(Request $request, AuthenticationUtils $utils)
    {

    	$error = $utils->getLastAuthenticationError();

    	$lastUsername =  $utils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'error' => $error,
            'last_username' => $lastUsername,
        ]);
    }


    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {

       
    }

    /**
     * @Route("/reset/password", name="reset-password")
     */
    public function resetPassword(Request $request)
    {
        $password = $request->request->get('password');
        $id = $request->request->get('id');

        $user = $this->getDoctrine()->getRepository(User::class)->find($id);

        $user->setPassword(
             $this->encoder->encodePassword($user, $password)
        );

        /*Guardo credenciales de acceso del empleado en la table User */
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();


        return new JsonResponse("Aviso! Hemos actualizado su contraseña correctamente");
       
    }


    /**
    * @Route("/reset/password/user", name="reset-password-user")
    */
    public function resetPasswordUser(Request $request)
    {
        $password = $request->request->get('password');

        $email = $request->request->get('id');

        $userArray = $this->getDoctrine()->getRepository(User::class)->findBy(
            ['email' => $email]
        );

        $user = $userArray[0];


   
        $user->setPassword(
             $this->encoder->encodePassword($user, $password)
        );

        /*Guardo credenciales de acceso del empleado en la table User */
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();


        return new JsonResponse("Aviso! Hemos actualizado su contraseña correctamente");
       
    }

}

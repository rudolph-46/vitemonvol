<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class UserController extends AbstractController
{
    /**
     * @Route("/admin/users", name="admin-users")
     */
    public function index(UserRepository $userRepository): Response
    {
       return $this->render('admin/client/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }
     /**
     * @Route("/admin/users/{id}/changeRole", name="admin_changeRole", methods={"GET","POST"})
     */
    public function changeRole(Request $request, User $user): Response
    {
    	$user->setRoles(array("ROLE_ADMIN"));
    	 $this->getDoctrine()->getManager()->persist($user);
    	 $this->getDoctrine()->getManager()->flush();
 		return $this->redirectToRoute('admin-users', [], Response::HTTP_SEE_OTHER);
       
    }

}

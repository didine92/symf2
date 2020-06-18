<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Component\HttpFoundation\Request;
use DateTime;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="security_registration")
     */
    
	public function registration(request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder) {
		
	
		
		$user = new User();
		
		$form = $this->createForm(RegistrationType::class, $user);
		$form->handleRequest($request);
		
		if($form->isSubmitted() && $form->isValid()){
			$user->setCreationDate(new \DateTime());
			$user->setUpdateDate(new \DateTime());
			$user->setCreationUser(1);
			$user->setUpdateUser(2);
			
			$hash = $encoder->encodePassword($user, $user->getPassword());
			
			$user->setPassword($hash);
			
			$manager->persist($user);
			$manager->flush();	
		}
		
		return $this->render('security/registration.html.twig',[
			 'form' => $form->createView()
		]);

	}
}	
	
//	/**
//     * @Route("/security", name="security")
//     */
//    public function index()
//    {
//      return $this->render('security/index.html.twig', [
//        'controller_name' => 'SecurityController',
//      ]);
//    }
//}

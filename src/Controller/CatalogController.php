<?php

namespace App\Controller;


use App\Repository\CatalogRepository;
use App\Entity\Catalog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use \Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class CatalogController extends AbstractController
{
    /**
     * @Route("/catalog", name="catalog")
     */
    public function index()
    {
		$repoCatalog = $this->getDoctrine()->getRepository(Catalog::class);
		
		$catalogs = $repoCatalog->findAll();
		
        return $this->render('catalog/index.html.twig', [
            'controller_name' => 'CatalogController',
			'catalogs'=> $catalogs
        ]);
    }
	
	
	/**
     * @Route("/catalog/new", name="catalog_create")
     */
    public function createCatalog(Request $request)
    {
		$manager = $this->getDoctrine()->getManager();
		$catalog = new Catalog();
		
		$form = $this->createFormBuilder($catalog)
            ->add('name', TextType::class,[
				'attr'=>[
					'placeholder' => "Nom de La catégorie",
					'class' => 'form-control'
				]	
			])
            ->add('decription', TextType::class,[
				'attr'=>[
					'placeholder' => "Description",
					'class' => 'form-control'
				]	
			])
//			->add('save',SubmitType::class, ['label' => 'créer'])
            ->getForm();
		
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$catalog->setCreationDate(new \DateTime());
			$catalog->setUpdateDate(new \DateTime());
			$catalog->setCreationUser(1);
			$catalog->setUpdateUser(2);
			
			$manager->persist($catalog);
			$manager->flush();
			
			
		return $this->redirectToRoute('catalog');
		}
		
		
		
        return $this->render('catalog/create.html.twig', [
            'controller_name' => 'CatalogController',
			'formCatalog'=> $form->createView()
        ]);
    }
	
	
	
}

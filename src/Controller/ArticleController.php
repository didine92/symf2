<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Catalog;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article")
     */
    public function index()
    {
		$repoArticle = $this->getDoctrine()->getRepository(Article::class);
		
		$articles = $repoArticle->findAll();
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
			'articles'=>$articles
        ]);
    }
	
	/**
     * @Route("/article/new", name="article_create")
     */
    public function  createArticle(Request $request)
    {			
		$manager = $this->getDoctrine()->getManager();
		
		$article = new Article();
		
		$form = $this->createFormBuilder($article)
            ->add('name', TextType::class,[
				'attr'=>[
					'placeholder' => "Nom de L'article",
					'class' => 'form-control'
				]
			])
            ->add('description', TextType::class,[
				'attr'=>[
					'placeholder' => "Description de L'article",
					'class' => 'form-control'
				]	
			])
			->add('priceHt', TextType::class,[
				'attr'=>[
					'placeholder' => "Prix de L'article",
					'class' => 'form-control'
				]	
			])
			->add('catalog', EntityType::class,[
				'class'=>Catalog::class,
				'choice_label'=>'name'
			])
//			->add('save',SubmitType::class, ['label' => 'créer'])
            ->getForm();
		
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$article->setCreationDate(new \DateTime());
			$article->setUpdateDate(new \DateTime());
			$article->setCreationUser(1);
			$article->setUpdateUser(2);
			
			$manager->persist($article);
			$manager->flush();
				
			return $this->redirectToRoute('article');
		}
		
		
		
        return $this->render('article/create.html.twig', [
            'controller_name' => 'ArticleController',
			'formArticle'=> $form->createView()
        ]);
    }
	
	/**
     * @Route("/article/{id}", name="articleId")
     */
    public function editArticle(Request $request)
    {
		$id = $request->get('id');
		
		$repoArticle = $this->getDoctrine()->getRepository(Article::class);
					
		$article = $repoArticle->find($id);
		
		return $this->render('article/show.html.twig', [
            'controller_name' => 'ArticleController',
			'article'=> $article
        ]);
    }
	
	
    /**
     * @Route("/articles/{idCatalog}", name="articles")
     */
    public function listArticles(Request $request)
    {	
		$idCatalog = $request->get('idCatalog');
				
		$repoArticle = $this->getDoctrine()->getRepository(Article::class);
		
		$articles = $repoArticle->findBy(Array('catalog'=>$idCatalog));
        return $this->render('article/index.html.twig', [
            'controller_name' => 'ArticleController',
			'articles'=>$articles
        ]);
    }

}

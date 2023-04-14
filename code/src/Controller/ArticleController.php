<?php

namespace App\Controller;

use App\Form\Type\ArticleType;
use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ObjectManager;

class ArticleController extends AbstractController
{
    #[Route('/new/', name: 'article_new')]
    public function new(Request $request): Response
    {
        $article = new Article();
        $article->setTitle('Article title here');
        $article->setText('Article text here');
        $article->setImage('Article image link here');

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $article = $form->getData();
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->render('pages/view.html.twig', [
            'article' => $article,
        ]);    
        }

        return $this->render('pages/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/edit/{id}', name: 'article_edit')]
    public function edit(Request $request, Article $article): Response
    {
        $article->getTitle();
        $article->getText();
        $article->getImage();

        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $article = $form->getData();
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->render('pages/view.html.twig', [
            'article' => $article,
        ]);    
        }

        return $this->render('pages/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }
}
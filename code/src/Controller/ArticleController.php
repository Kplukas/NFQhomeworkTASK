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

class ArticleController extends AbstractController
{
    #[Route('/new/', name: 'article_new')]
    public function new(): Response
    {
        $article = new Article();
        $article->setTitle('Article title here');
        $article->setText('Article text here');
        $article->setImage('Article image link here');

        $form = $this->createForm(ArticleType::class, $article);

        return $this->render('pages/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
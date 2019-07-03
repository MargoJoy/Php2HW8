<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleFormType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticleAdminController extends AbstractController
{
    /**
     * @Route("/admin/new", name="app_article_new")
     */
    public function new(EntityManagerInterface $em,Request $request)
    {
        $form = $this->createForm(ArticleFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Article $article */
            $article = $form->getData();

            $em->persist($article);
            $em->flush();
            return $this->redirectToRoute('app_articles');
        }

        return $this->render('admin/new_article.html.twig', [
            'articleForm' =>$form->createView()
        ]);
    }

    /**
     * @param ArticleRepository $articleRepo
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/admin/articles", name="app_articles")
     */
    public function list(ArticleRepository $articleRepo)
    {
        $articles = $articleRepo->findAll();
        return $this->render('admin/list_articles.html.twig',[
            'articles' => $articles,
        ]);
    }

}
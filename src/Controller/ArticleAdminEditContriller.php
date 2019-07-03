<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticleAdminEditContriller extends AbstractController
{
    /**
     * @Route("/admin/article/{id}/edit", name="app_article_edit")
     */
    public function edit(Article $article, EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(ArticleFormType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Article $article */
            $article = $form->getData();

            $em->persist($article);
            $em->flush();
            return $this->redirectToRoute('article_show',[
                'slug' => $article->getSlug(),
            ]);
        }

        return $this->render('admin/edit_article.html.twig', [
            'articleForm' =>$form->createView()
        ]);
    }
}
<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleFormType;
use App\Service\UploaderHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticleAdminEditController extends AbstractController
{
    /**
     * @Route("/admin/article/{id}/edit", name="app_article_edit")
     * @param Article $article
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function edit(Article $article, Request $request, EntityManagerInterface $em, UploaderHelper $uploaderHelper)
    {
        $form = $this->createForm(ArticleFormType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /**@var UploadedFile $uploadedFile*/
            $uploadedFile = $form['imageFile']->getData();
            if ($uploadedFile) {
                $newFilename = $uploaderHelper->uploaderArticleImage($uploadedFile);
                $article->setImageFilename($newFilename);
            }
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
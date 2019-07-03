<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ArticleAdminDeleteController extends AbstractController
{
    /**
     * @Route("/article/admin/delete/{id}", name="article_admin_delete")
     */
    public function delete(Article $article, EntityManagerInterface $em)
    {
        /** @var Article $article */
        $em->remove($article);
        $em->flush();
        return $this->redirectToRoute('app_articles');
    }
}

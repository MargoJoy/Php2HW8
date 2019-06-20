<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 020 20.06.19
 * Time: 16:01
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function homepage()
    {
        return $this->render('article/homepage.html.twig');
    }
}
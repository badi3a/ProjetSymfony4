<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="homePage")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }





    /**
     * @Route("/hello", name="helloPage")
     */
    public function hello(): Response
    {
        return $this->render('home/hello.html.twig');
    }
    /**
     * @Route("/helloName", name="helloByNamePage")
     */
    public function helloByName(): Response
    {   $name="Ali";
        return $this->render('home/hello.html.twig',
        [
            "name"=>$name
        ]);
    }

}

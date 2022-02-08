<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InternshipController extends AbstractController
{
    /**
     * @Route("/internship", name="internshipPage")
     */
    public function listInternship(): Response
    {   $listInternship=[
        ["ref"=>12, "title"=>"Angular Project", "company"=>"Vermeg","available"=>4],
        ["ref"=>54, "title"=>"Symofny Project", "company"=>"Focus","available"=>0]
    ];
        return $this->render('internship/list.html.twig',
        array('listInternship'=>$listInternship)
        );
    }
   /**
    * @Route("/internship/{ref}/{company}", name="showInternship")
    */
    public function showDetail($ref,$company):Response{
        return $this->render('internship/show.html.twig',
        [
            'ref'=>$ref,
            'c'=>$company
        ]
        );
    }

}

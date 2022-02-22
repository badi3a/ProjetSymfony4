<?php

namespace App\Controller;

use App\Entity\Classroom;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 *@Route("/classroom")
 */
class ClassroomController extends AbstractController
{
    /**
     * @Route("/classroom", name="classroom")
     */
    public function index(): Response
    {
        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'ClassroomController',
        ]);
    }
    //method => getAllClassroom
    /**
     * @Route("/list", name="listClassroomPage")
     */
    public function listClassroom(): Response{
       $list=$this->getDoctrine()
           ->getRepository(Classroom::class)
           ->findAll();
       return $this->render('classroom/list.html.twig',
                   ['list'=>$list]
       );
    }



    //method => Add Classroom
    //method => update classroom
    //method => delete classroom
}

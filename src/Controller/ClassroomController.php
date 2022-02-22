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
    //method => delete classroom
    /**
     * @Route("delete/{id}", name="deleteClassroom")
     */
    public function deleteClassroom($id):Response{
        //prepare the manager
        $em= $this->getDoctrine()->getManager();
        //object
        $classroom=$em->getRepository(Classroom::class)->find($id);
        //remove the object
        $em->remove($classroom);
        //remove from database
        $em->flush();
        return $this->redirectToRoute('listClassroomPage');
    }
    //method => Add Classroom
    //method => update classroom

}

<?php

namespace App\Controller;

use App\Entity\Classroom;
use App\Form\ClassroomType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    /**
     * @Route("/new",name="newClassroom")
     */
    public function addClassroom(Request $request):Response{
        //create an instance of ClassRoom
        $classroom= new Classroom();
        //create the form
        $form=$this
            ->createForm(ClassroomType::class,$classroom);
        $form=$form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            //persist data into the DB
            $em=$this->getDoctrine()->getManager();
            $em->persist($classroom);
            $em->flush();
            return $this->redirectToRoute("listClassroomPage");
        }
        //return the form
        return $this->render('classroom/new.html.twig',[
            'form'=>$form->createView()
            ]);
    }

    //method => update classroom
    /**
     * @Route("/update/{id}",name="updateClassroom",)
     */
    public function updateClassroom($id, Request $request): Response{
        $classroom= $this->getDoctrine()
            ->getRepository(Classroom::class)
            ->find($id);
        $form= $this->createForm(ClassroomType::class,$classroom);
        $form=$form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('listClassroomPage');
        }
        return $this->render('classroom/new.html.twig',[
            'form'=>$form->createView()
        ]);
    }
}

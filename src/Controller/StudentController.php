<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/student")
 */
class StudentController extends AbstractController
{
   /**
    * @Route("/list",name="listStudent")
    */
   public function listStudent():Response{
       $list=$this->getDoctrine()
           ->getRepository(Student::class)
           ->findAll();
       return $this->render('student/list.html.twig',
       [
           'list'=>$list
       ]);
   }
    /**
     * @Route("/new",name="add-student")
     */
    public function newStudent(Request $request):Response
    {
        $student = new Student();
        $form = $this->createForm(StudentType::class , $student);
        $form= $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($student);
            $em->flush();
            return $this->redirectToRoute("listStudent");
        }
        return $this->render("student/new.html.twig",[
            "form"=>$form->createView()


        ]);



    }

}

<?php

namespace App\Controller;

use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Form\StudentType;
use App\Entity\Student;

class  StudentController extends AbstractController
{
    /**
     * @Route("/student/new", name="student_new", methods={"POST", "GET"})
     */
    public function new(Request $request)
    {
        $student = new Student();
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            return $this->create($student);
        }
        $template = 'student/new.html.twig';
        $argsArray = [
            'form' => $form->createView(),
        ];
        return $this->render($template, $argsArray);
    }

    /**
     * @Route("/student", name="student")
     */
    public function list()
    {
        $studentRepository = $this->getDoctrine()->getRepository('App:Student');
        $students = $studentRepository->findAll();
        $argsArray = [
            'students' => $students
        ];
        $templateName = 'student/list';
        return $this->render($templateName . '.html.twig', $argsArray);
    }

    /**
     * @Route("/student/{id}", name="student_show")
     */
    public function show(Student $student)
    {
        $template = 'student/show.html.twig';
        $args = [
            'student' => $student
        ];
        if (!$student) {
            $template = 'error/404.html.twig';
        }
        return $this->render($template, $args);
    }

    public function create(Student $student)
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($student);
        $em->flush();
        return $this->redirectToRoute('student');
    }

    /**
     * @Route("/{id}", name="student_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Student $student): Response
    {
        if ($this->isCsrfTokenValid('delete'.$student->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($student);
            $entityManager->flush();
        }

        return $this->redirectToRoute('student');
    }

    /**
     * @Route("/{id}/edit", name="student_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Student $student): Response
    {
        $form = $this->createForm(StudentType::class, $student);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('student');
        }

        return $this->render('student/edit.html.twig', [
            'student' => $student,
            'form' => $form->createView(),
        ]);
    }
}
<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HeadController extends AbstractController
{
    /**
     * @Route("/head", name="head")
     */
    public function index()
    {
        return $this->render('head/index.html.twig', [
            'controller_name' => 'HeadController',
        ]);
    }
}

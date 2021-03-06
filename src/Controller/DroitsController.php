<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DroitsController extends AbstractController
{
    /**
     * @Route("/droits", name="droits")
     */
    public function index()
    {
        return $this->render('droits/index.html.twig', [
            'controller_name' => 'DroitsController',
        ]);
    }
}

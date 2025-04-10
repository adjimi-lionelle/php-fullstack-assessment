<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TopListController extends AbstractController
{
    #[Route('', name: 'app_top_list')]
    public function index(): Response
    {
        return $this->render('top_list/index.html.twig', [
            'controller_name' => 'TopListController',
        ]);
    }
}

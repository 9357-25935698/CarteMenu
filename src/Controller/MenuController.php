<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PlatsRepository;


class MenuController extends AbstractController
{
    /**
     * @Route("/menu", name="app_menu")
     */
    public function menu(PlatsRepository $pl): Response
    {

        $plats = $pl->findAll();
        return $this->render('menu/index.html.twig', [
            'plats' => $plats
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PlatsRepository;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(PlatsRepository $pl): Response
    {
        
        $plats = $pl->findAll();

        $Random = array_rand($plats, 2);

        return $this->render('home/index.html.twig', [
            'plat1' => $plats[$Random[0]],
            'plat2' => $plats[$Random[1]],
        ]);
    }

    /**
     * @Route("/contact", name="app_contact")
     */
    public function contact(): Response
    {
        
        

        return $this->render('home/contact.html.twig', [
            
        ]);
    }

   

}

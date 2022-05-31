<?php

namespace App\Controller;

use App\Entity\Plats;

use App\Form\PlatType;
use App\Repository\PlatsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile; 
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;





   
class PlatsController extends AbstractController
{
    /**
     * @Route("/plats", name="app_plats")
     */
    public function index(PlatsRepository $pl)
    {
        $plat = $pl->findAll();
        return $this->render('plats/index.html.twig', [
            'plat' => $plat
        ]);
    }

    /**
     * @Route("/create", name="app_create")
     */
    public function create(Request $request)
    {
        $plats = new Plats();

        //Formulaire

        $form = $this->createForm(PlatType::class, $plats);
        $form->handleRequest($request);

        if ($form->isSubmitted()){

        //EntityManager
        $em = $this->getDoctrine()->getManager();
        $Image = $form->get('Photo')->getData();

        if ($Image) {
           $filename = md5(uniqid()). '.' . $Image->guessClientExtension();
 
        }

        $Image->move(
              $this->getParameter('Image_dossier'),
              $filename 
        );

        $plats->setImage($filename);
        $em->persist($plats);
        $em->flush();

        return $this->redirect($this->generateUrl('app_plats'));
        
        }

        //Response
        return $this->render('plats/create.html.twig', [
            'createForm' => $form->createView() 
        ]);
        
    }
    /**
     * @Route("/retirer/{id}", name="app_retirer")
     */
    public function retirer($id, PlatsRepository $pl){

        $em = $this->getDoctrine()->getManager();
        $plats = $pl->find($id);
        $em->remove($plats);
        $em->flush();

        //message
        $this->addFlash('Succès','Plat a été supprimé avec succès');
        
        return $this->redirect($this->generateUrl('app_plats'));
    }

     /**
     * @Route("/afficher/{id}", name="app_afficher")
     */
    public function afficher(Plats $plat){
        return $this->render('plats/afficher.html.twig', [
            'plat' => $plat
        ]);   
    
    }

}

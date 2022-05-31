<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
class InscriptionController extends AbstractController
{
    /**
     * @Route("/inscription", name="app_inscription")
     */
    public function inscription(Request $req, UserPasswordEncoderInterface $passEncoder): Response
    {

        $inscForm= $this->createFormBuilder()
        ->add('username', TextType::class,[
                'label' => 'Employé'])

        ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat Password'],
        ])
        
        ->add('Inscription', SubmitType::class)
        ->getForm()
        ;
        $inscForm->handleRequest($req);

        if($inscForm->isSubmitted()){
            $input = $inscForm->getData();
            $user = new User();
            $user->setUsername($input['username']) ;

            $user->setPassword($passEncoder->encodePassword($user, $input['password']));

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirect($this->generateUrl('app_home'));
        }


        return $this->render('inscription/index.html.twig', [
            'inscForm' => $inscForm->createView()
        ]);
    }
}

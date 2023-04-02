<?php

namespace App\Controller;

use App\Entity\Bl;
use App\Entity\User;
use App\Form\BlType;
use App\Form\AllBlType;
use App\Entity\Livraison;
use App\Form\FiltreMesblType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MonblController extends AbstractController
{
    /**
     * @Route("/monbl", name="monbl")
     */
    public function index(Request $request, EntityManagerInterface  $manager)
    {
        //test
        $test="rien";
        $Bl=new Bl();   
           
        $Bl->setDate(new \DateTime());
        $form= $this->CreateForm(FiltreMesblType::class, $Bl);

        $form->handleRequest($request);

                
        $port=$Bl->getPorteur();

        $user = $this->getUser();
        
        $repository = $this->getDoctrine()->getRepository(Bl::class);
            
        $Bls = $repository->findBy(
            ['user_info' => $this->getUser()->getId()]
        );

        if ($form->isSubmitted() && $form->isValid()  ){
          
        $Bls = $repository->findBy(
            ['user_info' => $this->getUser()->getId(),
             'porteur' => $port]
        );

        }
  
     
        return $this->render('monbl/index.html.twig', [
            'form'=>$form->createView(),
            'items' => $Bls
        ]);
    }



     /**
     * @Route("/admin/utilisateur", name="utilisateur")
     */
    public function utilisateur(Request $request, EntityManagerInterface  $manager)
    {

       



        $user = $this->getUser();
        
        $repository = $this->getDoctrine()->getRepository(User::class);
        $user = $repository->findAll();

        return $this->render('monbl/user.html.twig', [ 
            'items' => $user
        ]);
    }



      /**
     * @Route("/admin/bl", name="all_bl")
     */
    public function bl(Request $request, EntityManagerInterface  $manager)
        { 

        $Bl=new Bl();   
           
        $Bl->setDate(new \DateTime());
        $form= $this->CreateForm(AllBlType::class, $Bl);

        $form->handleRequest($request);

       
        $repository = $this->getDoctrine()->getRepository(Bl::class);
        $Bls = $repository->findAll();
        if ($form->isSubmitted() && $form->isValid()  ){

            $us=$Bl->getUserInfo()->getId();
            $Bls = $repository->findBy(
                ['user_info' => $us]
            );

        }



        $user = $this->getUser();
        
      
        return $this->render('monbl/index.html.twig', [
            'form'=>$form->createView(),
            'items' => $Bls
        ]);

    }

    
}

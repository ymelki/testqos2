<?php

namespace App\Controller;

use App\Entity\Ordersa;
use App\Entity\Livraison;
use App\Form\OrdersaType;
use App\Form\LivraisonType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrdersaController extends AbstractController
{
    /**
     * @Route("/admin/ordersa", name="ordersa")
     */
    public function index(Request $request, EntityManagerInterface  $manager): Response
    {
        $Ordersa=new Ordersa();       
        
        $form= $this->CreateForm(OrdersaType::class, $Ordersa);

        $form->handleRequest($request);
        $inf=$Ordersa->getId();
        
        $repository = $this->getDoctrine()->getRepository(Ordersa::class);
        $cmdts = $repository->findOneBy(array(), array('id' => 'DESC'));
        $cmdts = $cmdts->getId();

        if ($form->isSubmitted() && $form->isValid() && $inf>$cmdts ){
 
            $sql = "INSERT INTO `ordersa` (`id`) VALUES ($inf);";
            $stmt = $manager->getConnection()->prepare($sql);
            $result = $stmt->execute(); 
             
        }

        $repository = $this->getDoctrine()->getRepository(Ordersa::class);
        $cmdts = $repository->findOneBy(array(), array('id' => 'DESC'));
        $cmdts = $cmdts->getId();
        return $this->render('ordersa/ordersa.html.twig', 
            ['form'=>$form->createView(), 'last_id'=>$cmdts] 
        );
    }


     /**
     * @Route("/admin/livraison", name="livre")
     */
    public function livraisons(Request $request, EntityManagerInterface  $manager): Response
    {     
        $Livraison=new Livraison();      
        $form= $this->CreateForm(LivraisonType::class, $Livraison);
        $form->handleRequest($request);
        $inf=$Livraison->getId();
        $Livraison->setDate(new \DateTime());

        $repository = $this->getDoctrine()->getRepository(Livraison::class);
        $livraisons = $repository->findOneBy(array(), array('id' => 'DESC'));
        $livraisons = $livraisons->getId();
        
        if ($form->isSubmitted() && $form->isValid() && $inf>$livraisons ){
 
            $sql = "INSERT INTO `livraison` (`id`,`date`) VALUES ($inf, '2021-01-24' );";
            $stmt = $manager->getConnection()->prepare($sql);
            $result = $stmt->execute(); 
             
        }
        
         
        
        $repository = $this->getDoctrine()->getRepository(Livraison::class);
        $livraisons = $repository->findOneBy(array(), array('id' => 'DESC'));
        $livraisons = $livraisons->getId();

 
        return $this->render('ordersa/livraison.html.twig', 
            ['form'=>$form->createView(), 'last_id'=>$livraisons] 
        );
    }
}

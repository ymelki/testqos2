<?php

namespace App\Controller;

use DateTime;
use App\Entity\Bl;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Entity\Tcmd;
use App\Form\BlType;



use App\Entity\Ordersa;

// Include Dompdf required namespaces
use App\Entity\Produit;
use setasign\Fpdi\Fpdi;
use App\Entity\Livraison;
use App\Controller\DefaultController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlController extends AbstractController
{
    /**
     * @Route("/bl", name="bl")
     */
    public function index(Request $request, EntityManagerInterface  $manager, SessionInterface $session) 
    {
        /*
        $session=$request->getSession();      
        $session->clear();
*/ 
        $bl=new Bl();
        
        $form= $this->CreateForm(BlType::class, $bl);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() ){
            $user = $this->getUser();

            $bl->setUserInfo($user);

            $livraison=new Livraison();
            $livraison->setDate(new \DateTime());

            $bl->setLivraison($livraison);

            //Création du panier
 
            $panier=$session->get('panier', []);
 
            if (empty($panier)) {             
                $tsd=1;
            }
 
            if (!empty($panier)) {
                $tsd=array_key_last($panier)+1;             
                $panier[$tsd]=$bl;
            }
            $panier[$tsd]=$bl;
            $session->set('panier',$panier);
 
/*
            $manager->persist($livraison);
            $manager->flush();

            $manager->persist($bl);
            $manager->flush();
            return $this->redirectToRoute('bl');*/
        }
 
        return $this->render('/bl/index.html.twig',
           ['form'=>$form->createView(),
            'items'=>$session->get('panier')
            ] );

    }

     /**
     * @Route("/pannier/add/{id}", name="cart_add")
     */
    public function add($id, Request $request){
        $session=$request->getSession();
        $panier=$session->get('panier', []);

        $panier[$id]=1;
        $session->set('panier',$panier);

      
        

    }

     /**
     * @Route("/remove/{id}", name="remove")
     */
     public function remove($id, SessionInterface $session){


        $panier=$session->get('panier', []);
        
        if (!empty($panier[$id])) {
            unset($panier[$id]);
        }
        
        $session->set('panier',$panier);
        return $this->redirectToRoute('bl');

     }

     /**
     * @Route("/generer", name="generer")
     */
     public function generer(Request $request, EntityManagerInterface  $manager, SessionInterface $session) 
     {
 
        
        $bl=new Bl();
        
        $form= $this->CreateForm(BlType::class, $bl);

        $form->handleRequest($request);
 
            $user = $this->getUser();

            $bl->setUserInfo($user);

            $livraison=new Livraison();
            $commande=new Ordersa();
            
            $livraison->setDate(new \DateTime());

            $bl->setLivraison($livraison);
            $bl->setOrdersa($commande);
            $bl->setDate(new \DateTime());

            //Création du panier

            
            $panier=$session->get('panier', []);



            
            $manager->persist($livraison);
            $manager->flush();

            $manager->persist($commande);
            $manager->flush();


            foreach ($panier as $pan) { 
                $bl=new Bl(); 
                $bl->setLivraison($livraison);
                $bl->setOrdersa($commande);
                $bl->setUserInfo($user);
            $bl->setQuantite($pan->getQuantite());
            $bl->setProduit($pan->getProduit());
            $bl->setDesignation($pan->getDesignation());
            $bl->setPorteur($pan->getPorteur());
            $bl->setUserInfo($user);
            
            $bl->setDate(new \DateTime());

            $manager->persist($bl);
            $manager->flush();
            }

            // GENERER LE PDF
             

// Create new Landscape PDF
$pdf = new Fpdi('l');

// Reference the PDF you want to use (use relative path)
$pagecount = $pdf->setSourceFile( 'certificate.pdf' );

// Import the first page from the PDF and add to dynamic PDF
$tpl = $pdf->importPage(1);
$pdf->AddPage("P");

// Use the imported page as the template
$pdf->useTemplate($tpl);

// Afficher hello world
//Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])
$pdf->SetFont('Arial','B',12); 

// Numero de B.L.
$pdf->SetXY(174.5, 13.7); // set the position of the box
$pdf->Cell(0, 0, $bl->getLivraison()->getId(), 0, 0);

$pdf->SetFont('Arial'); 
$pdf->SetFontSize(10);

// DATE
$pdf->SetXY(120, 32.5); // set the position of the box
$pdf->Cell(0, 0, date("d/m/Y"), 0, 0);

// NUM CLIENT
$pdf->SetXY(154, 32.5); // set the position of the box
$pdf->Cell(0, 0, $bl->getUserInfo()->getCodeClient() , 0, 0);

// INFO ADRESSE CLIENT
$pdf->SetFont('Arial',"B"); 
$pdf->SetFontSize(10);
$pdf->SetXY(117, 44.5); // set the position of the box
$pdf->Cell(0, 0, $bl->getUserInfo()->getMagasin(), 0, 0);

$pdf->SetXY(117, 50.5); // set the position of the box
$pdf->Cell(0, 0, $bl->getUserInfo()->getAdresse(), 0, 0);

$pdf->SetXY(117, 56.5); // set the position of the box
$pdf->Cell(0, 0, $bl->getUserInfo()->getCp()." ". $bl->getUserInfo()->getVille(), 0, 0);

// DESIGNATION
$i=1;
$j=0;

//dd($panier);

$pdf->SetFont('Arial'); 
$pdf->SetFontSize(8);

    $pdf->SetXY(36, 106); // DESIGNATION
    $pdf->Cell(0, 0, "Commande client : CC_0".$bl->getOrdersa()->getId(), 0, 0);
foreach ($panier as $pan) { 


    $prod = explode("-", $pan->getProduit());

    $pdf->SetXY(195, 106+$j+5); // QUANTITE CODE
    $pdf->Cell(0, 0, $pan->getQuantite(), 0, 0);

    $pdf->SetXY(177, 106+$j+5); // QUANTITE LIVREE
    $pdf->Cell(0, 0, $pan->getQuantite(), 0, 0);


    $pdf->SetXY(36, 106+$j+5); // DESIGNATION
    $pdf->Cell(0, 0, "".$prod[1], 0, 0);

    $pdf->SetXY(36, 106+$j+10); // DESIGNATION
    $pdf->Cell(0, 0, "".$pan->getDesignation(), 0, 0);
    $pdf->SetXY(36, 106+$j+15); // DESIGNATION
    $pdf->Cell(0, 0, "".$pan->getPorteur(), 0, 0);


    $pdf->SetXY(9, 106+$j+5); // REFERENCE
    $pdf->Cell(0, 0, $prod[0], 0, 0);
   
   
    $i++;
    $j=$j+25;    
}






$filename="BL_".$bl->getOrdersa()->getId().".pdf";
//Output the document
$dir = "../public/"; // full path like C:/xampp/htdocs/file/file/

$pdf->Output($dir.$filename,'F');

// render PDF to browser
$pdf->Output();  
            
              
            //supprimer le tableau
           $session->remove('panier');
/*

        return $this->render('/bl/index.html.twig',
        ['form'=>$form->createView(),
         'items'=>$session->get('panier')
         ] ); 
    */


     }

     
     /**
     * @Route("/donwload/{id}", name="download", methods={"GET"})
     */
    public function donwload($id,Request $request, EntityManagerInterface  $manager, SessionInterface $session) 
    {
            
        $response = new BinaryFileResponse('../public/BL_'.$id.'.pdf');
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT,'BL_'.$id.'.pdf');
        return $response;
        
    }

    }


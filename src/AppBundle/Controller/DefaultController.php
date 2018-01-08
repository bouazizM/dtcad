<?php

namespace AppBundle\Controller;

use AppBundle\Entity\info;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
class DefaultController extends Controller
{
    /**
     * @Route("/generate", name="generate")
     */
    public function generateAction(Request $request)
    {
      $info=new info();


       // $request = $this->getRequest();
        $info=$request->query->get('info');
        echo $info ;
        $snappy = $this->get('knp_snappy.pdf');

     /*   $html = $this->renderView('Default/template.html.twig', array(
            'title' => 'Hello World !',
            'info'=>$info
        ));

        $filename = 'myFirstSnappyPDF';

        return new Response(
            $snappy->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'inline; filename="'.$filename.'.pdf"'
            )
        );*/

    return  $this->render('default/index.html.twig',array('adr'=>$info));
    }


    /**
     * @Route("/",name="homepage")
     */
    public function indexAction(Request $request){
        return $this->render("default/index.html.twig");
    }
}

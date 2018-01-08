<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Etudiant;
use AppBundle\Form\EtudiantType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\View\View;
class EtudiantController extends Controller
{

    /**
     * @Route("/etudiant", name="etudiant")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $etudiant = $em->getRepository('AppBundle:Etudiant')->findAll();

        return $this->render('Etudiant/index.html.twig', array(
            'etudiant' => $etudiant,
        ));

    }

    /**
     * @Get("/places")
     * @Route("/places",name="place")
     */
    public function getPlacesAction(Request $request)
    {
        $places = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Etudiant')
            ->findAll();
        /* @var $places Place[] */

        $formatted = [];
        foreach ($places as $place) {
            $formatted[] = [
                'id' => $place->getId(),
                'name' => $place->getlastName(),
                'address' => $place->getfirstName(),
            ];
        }

        // Récupération du view handler
        $viewHandler = $this->get('fos_rest.view_handler');

        // Création d'une vue FOSRestBundle
        $view = View::create($formatted);
        $view->setFormat('json');

        // Gestion de la réponse
        return $viewHandler->handle($view);
    }


    /**
     * @Route("/etudiant/new", name="new_etudiant")
     */
    public function new_etudiantAction(Request $request)
    {
        $etudiant=new Etudiant();
        $form = $this->createForm(EtudiantType::class, $etudiant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $etudiant = $form->getData();

            $file = $etudiant->getBrochure();

            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            // Move the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('brochures_directory'),
                $fileName
            );

            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $etudiant->setBrochure($fileName);

             $em = $this->getDoctrine()->getManager();
             $em->persist($etudiant);
             $em->flush();

            return $this->redirectToRoute('etudiant');
        }

        return $this->render('Etudiant/new.html.twig', array(
            'form' => $form->createView(),
            'etudiant'=>$etudiant
        ));

    }

    /**
     * Displays a form to edit an existing test entity.
     *
     * @Route("/{id}/edit", name="etudiant_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Etudiant $etudiant)
    {

        $editForm = $this->createForm('AppBundle\Form\EtudiantType', $etudiant);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('etudiant');
        }

        return $this->render('Etudiant/modifier.html.twig', array(
            'etudiant' => $etudiant,
            'edit_form' => $editForm->createView()
        ));
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/hide",name="hide")
     */
    public function hideAction(Request $request)
    {
        $places = $this->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:Etudiant')
            ->findAll();
        return $this->render('Etudiant/hide.html.twig',array('places'=>$places));
    }


    /**
     * Deletes a Ingredient entity.
     *
     * @Route("/{id}/delete", name="delete_etudiant")
     */
    public function supprimerAction($id)
    {
          $em=$this->getDoctrine()->getManager();
          $et=$em->find('AppBundle:Etudiant',$id);

            $em->remove($et);
            $em->flush();

            $this->render('Etudiant/index.html.twig');

    }

    }

<?php

namespace AppBundle\Controller;

use AppBundle\Entity\cv;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Cv controller.
 *
 * @Route("cv")
 */
class cvController extends Controller
{
    /**
     * Lists all cv entities.
     *
     * @Route("/", name="cv_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cvs = $em->getRepository('AppBundle:cv')->findAll();

        $message = \Swift_Message::newInstance()
            ->setSubject('Some Subject')
            ->setFrom('mohamedbouaziz24@gmail.com')
            ->setTo('mohamedbouaziz24@gmail.com')
            ->setBody('ExampleBundle:Default:mail.html.twig', 'text/html');

# Send the message
        $this->get('mailer')
            ->send($message);
        return $this->render('cv/index.html.twig', array(
            'cvs' => $cvs,
        ));
    }

    /**
     * Creates a new cv entity.
     *
     * @Route("/new", name="cv_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $cv = new Cv();
        $form = $this->createForm('AppBundle\Form\cvType', $cv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cv);
            $em->persist($cv->getParcours());
            $em->flush();

            return $this->redirectToRoute('cv_show', array('id' => $cv->getId()));
        }

        return $this->render('cv/new.html.twig', array(
            'cv' => $cv,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a cv entity.
     *
     * @Route("/{id}", name="cv_show")
     * @Method("GET")
     */
    public function showAction(cv $cv)
    {
        $deleteForm = $this->createDeleteForm($cv);

        return $this->render('cv/show.html.twig', array(
            'cv' => $cv,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing cv entity.
     *
     * @Route("/{id}/edit", name="cv_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, cv $cv)
    {
        $deleteForm = $this->createDeleteForm($cv);
        $editForm = $this->createForm('AppBundle\Form\cvType', $cv);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cv_edit', array('id' => $cv->getId()));
        }

        return $this->render('cv/edit.html.twig', array(
            'cv' => $cv,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a cv entity.
     *
     * @Route("/{id}", name="cv_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, cv $cv)
    {
        $form = $this->createDeleteForm($cv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cv);
            $em->flush();
        }

        return $this->redirectToRoute('cv_index');
    }

    /**
     * Creates a form to delete a cv entity.
     *
     * @param cv $cv The cv entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(cv $cv)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cv_delete', array('id' => $cv->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

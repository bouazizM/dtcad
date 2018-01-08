<?php

namespace AppBundle\Controller;

use AppBundle\Entity\parcour;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Parcour controller.
 *
 * @Route("parcour")
 */
class parcourController extends Controller
{
    /**
     * Lists all parcour entities.
     *
     * @Route("/", name="parcour_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $parcours = $em->getRepository('AppBundle:parcour')->findAll();

        return $this->render('parcour/index.html.twig', array(
            'parcours' => $parcours,
        ));
    }

    /**
     * Creates a new parcour entity.
     *
     * @Route("/new", name="parcour_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $parcour = new Parcour();
        $form = $this->createForm('AppBundle\Form\parcourType', $parcour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($parcour);
            $em->flush();

            return $this->redirectToRoute('parcour_show', array('id' => $parcour->getId()));
        }

        return $this->render('parcour/new.html.twig', array(
            'parcour' => $parcour,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a parcour entity.
     *
     * @Route("/{id}", name="parcour_show")
     * @Method("GET")
     */
    public function showAction(parcour $parcour)
    {
        $deleteForm = $this->createDeleteForm($parcour);

        return $this->render('parcour/show.html.twig', array(
            'parcour' => $parcour,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing parcour entity.
     *
     * @Route("/{id}/edit", name="parcour_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, parcour $parcour)
    {
        $deleteForm = $this->createDeleteForm($parcour);
        $editForm = $this->createForm('AppBundle\Form\parcourType', $parcour);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('parcour_edit', array('id' => $parcour->getId()));
        }

        return $this->render('parcour/edit.html.twig', array(
            'parcour' => $parcour,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a parcour entity.
     *
     * @Route("/{id}", name="parcour_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, parcour $parcour)
    {
        $form = $this->createDeleteForm($parcour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($parcour);
            $em->flush();
        }

        return $this->redirectToRoute('parcour_index');
    }

    /**
     * Creates a form to delete a parcour entity.
     *
     * @param parcour $parcour The parcour entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(parcour $parcour)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('parcour_delete', array('id' => $parcour->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

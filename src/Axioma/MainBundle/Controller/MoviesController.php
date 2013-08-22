<?php

namespace Axioma\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Axioma\MainBundle\Entity\Movies;
use Axioma\MainBundle\Form\MoviesType;

/**
 * Movies controller.
 *
 */
class MoviesController extends Controller
{
    /**
     * Lists all Movies entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AxiomaMainBundle:Movies')->findAll();

        return $this->render('AxiomaMainBundle:Movies:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Movies entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Movies();
        $form = $this->createForm(new MoviesType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('movies_show', array('id' => $entity->getId())));
        }

        return $this->render('AxiomaMainBundle:Movies:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Movies entity.
     *
     */
    public function newAction()
    {
        $entity = new Movies();
        $form   = $this->createForm(new MoviesType(), $entity);

        return $this->render('AxiomaMainBundle:Movies:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Movies entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AxiomaMainBundle:Movies')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Movies entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AxiomaMainBundle:Movies:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Movies entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AxiomaMainBundle:Movies')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Movies entity.');
        }

        $editForm = $this->createForm(new MoviesType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AxiomaMainBundle:Movies:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Movies entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AxiomaMainBundle:Movies')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Movies entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new MoviesType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('movies_edit', array('id' => $id)));
        }

        return $this->render('AxiomaMainBundle:Movies:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Movies entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AxiomaMainBundle:Movies')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Movies entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('movies'));
    }

    /**
     * Creates a form to delete a Movies entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}

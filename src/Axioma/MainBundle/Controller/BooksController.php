<?php

namespace Axioma\MainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Axioma\MainBundle\Entity\Books;
use Axioma\MainBundle\Form\BooksType;

/**
 * Books controller.
 *
 */
class BooksController extends Controller
{
    /**
     * Lists all Books entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AxiomaMainBundle:Books')->findAll();

        return $this->render('AxiomaMainBundle:Books:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Books entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Books();
        $form = $this->createForm(new BooksType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('books_show', array('id' => $entity->getId())));
        }

        return $this->render('AxiomaMainBundle:Books:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Books entity.
     *
     */
    public function newAction()
    {
        $entity = new Books();
        $form   = $this->createForm(new BooksType(), $entity);

        return $this->render('AxiomaMainBundle:Books:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Books entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AxiomaMainBundle:Books')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Books entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AxiomaMainBundle:Books:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Books entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AxiomaMainBundle:Books')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Books entity.');
        }

        $editForm = $this->createForm(new BooksType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('AxiomaMainBundle:Books:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Books entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AxiomaMainBundle:Books')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Books entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new BooksType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('books_edit', array('id' => $id)));
        }

        return $this->render('AxiomaMainBundle:Books:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Books entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AxiomaMainBundle:Books')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Books entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('books'));
    }

    /**
     * Creates a form to delete a Books entity by id.
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

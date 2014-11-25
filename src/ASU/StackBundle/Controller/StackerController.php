<?php

namespace ASU\StackBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ASU\StackBundle\Entity\Stacker;
use ASU\StackBundle\Form\StackerType;

/**
 * Stacker controller.
 *
 * @Route("/stacker")
 */
class StackerController extends Controller {

    /**
     * Lists all Stacker entities.
     *
     * @Route("/", name="stacker")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ASUStackBundle:Stacker')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Stacker entity.
     *
     * @Route("/", name="stacker_create")
     * @Method("POST")
     * @Template("ASUStackBundle:Stacker:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Stacker();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('stacker_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Stacker entity.
     *
     * @param Stacker $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Stacker $entity) {
        $form = $this->createForm(new StackerType(), $entity, array(
            'action' => $this->generateUrl('stacker_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Stacker entity.
     *
     * @Route("/new", name="stacker_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction() {
        $entity = new Stacker();
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a Stacker entity.
     *
     * @Route("/{id}", name="stacker_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ASUStackBundle:Stacker')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Stacker entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Stacker entity.
     *
     * @Route("/{id}/edit", name="stacker_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ASUStackBundle:Stacker')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Stacker entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Creates a form to edit a Stacker entity.
     *
     * @param Stacker $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Stacker $entity) {
        $form = $this->createForm(new StackerType(), $entity, array(
            'action' => $this->generateUrl('stacker_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Stacker entity.
     *
     * @Route("/{id}", name="stacker_update")
     * @Method("PUT")
     * @Template("ASUStackBundle:Stacker:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ASUStackBundle:Stacker')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Stacker entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('stacker_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Stacker entity.
     *
     * @Route("/{id}", name="stacker_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ASUStackBundle:Stacker')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Stacker entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('stacker'));
    }

    /**
     * Creates a form to delete a Stacker entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('stacker_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

}

<?php

namespace ASU\StackBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ASU\StackBundle\Entity\Win;
use ASU\StackBundle\Form\WinType;

/**
 * Win controller.
 *
 * @Route("/win")
 */
class WinController extends Controller {

    /**
     * Lists all Win entities.
     *
     * @Route("/", name="win")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ASUStackBundle:Win')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Win entity.
     *
     * @Route("/", name="win_create")
     * @Method("POST")
     * @Template("ASUStackBundle:Win:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Win();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('win_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Win entity.
     *
     * @param Win $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Win $entity) {
        $form = $this->createForm(new WinType(), $entity, array(
            'action' => $this->generateUrl('win_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Win entity.
     *
     * @Route("/new", name="win_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction() {
        $entity = new Win();
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a Win entity.
     *
     * @Route("/{id}", name="win_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ASUStackBundle:Win')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Win entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Win entity.
     *
     * @Route("/{id}/edit", name="win_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ASUStackBundle:Win')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Win entity.');
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
     * Creates a form to edit a Win entity.
     *
     * @param Win $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Win $entity) {
        $form = $this->createForm(new WinType(), $entity, array(
            'action' => $this->generateUrl('win_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Win entity.
     *
     * @Route("/{id}", name="win_update")
     * @Method("PUT")
     * @Template("ASUStackBundle:Win:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ASUStackBundle:Win')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Win entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('win_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Win entity.
     *
     * @Route("/{id}", name="win_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ASUStackBundle:Win')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Win entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('win'));
    }

    /**
     * Creates a form to delete a Win entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('win_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

}

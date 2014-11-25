<?php

namespace ASU\StackBundle\Form;

use ASU\StackBundle\Entity\Team;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TeamType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name', 'text', array(
                    'label' => "Name:",
                    'required' => true,
                    'attr' => array(
                        'class' => "input-large",
                    ),
                    'invalid_message' => "Please enter a name",
                ))
                ->add('description', 'textarea', array(
                    'label' => "Description:",
                    'required' => false,
                    'attr' => array(
                        'class' => "input-xlarge",
                    ),
                ))
                ->add('genre', 'choice', array(
                    'label' => "Genre:",
                    'required' => true,
                    'choices' => array(
                        Team::GENRE_SCHOOL => "School",
                        Team::GENRE_WORK => "Work",
                        Team::GENRE_RELIGIOUS => "Religious",
                    ),
                    'attr' => array(
                        'class' => "input-medium",
                    ),
                    'invalid_message' => "Please enter a category",
                ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'ASU\StackBundle\Entity\Team'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'asu_stackbundle_team';
    }

}

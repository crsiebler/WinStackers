<?php

namespace ASU\StackBundle\Form;

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
                ->add('title')
                ->add('description')
                ->add('xp')
                ->add('dateCreated')
                ->add('genre')
                ->add('creator')
                ->add('members')
        ;
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

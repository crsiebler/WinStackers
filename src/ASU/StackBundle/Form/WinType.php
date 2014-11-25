<?php

namespace ASU\StackBundle\Form;

use ASU\StackBundle\Entity\Win;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class WinType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('title', 'text', array(
                    'label' => "Title:",
                    'required' => true,
                    'attr' => array(
                        'class' => "input-large",
                    ),
                    'invalid_message' => "Please enter a title",
                ))
                ->add('description', 'textarea', array(
                    'label' => "Description:",
                    'required' => false,
                    'attr' => array(
                        'class' => "input-xlarge",
                    ),
                ))
                ->add('xp', 'integer', array(
                    'label' => "XP:",
                    'required' => true,
                    'attr' => array(
                        'class' => "input-medium",
                    ),
                    'invalid_message' => "Please enter a value greater than 0",
                ))
                ->add('category', 'choice', array(
                    'label' => "Categories:",
                    'required' => true,
                    'choices' => array(
                        Win::CATEGORY_CHORE => "Chore",
                        Win::CATEGORY_DUTY => "Duty",
                        Win::CATEGORY_GOAL => "Goal",
                        Win::CATEGORY_MILESTONE => "Milestone",
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
            'data_class' => 'ASU\StackBundle\Entity\Win'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'asu_stackbundle_win';
    }

}

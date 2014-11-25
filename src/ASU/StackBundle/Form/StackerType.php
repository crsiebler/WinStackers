<?php

namespace ASU\StackBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StackerType extends \KMJ\ToolkitBundle\Form\UserType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);

        $builder->remove('firstName')
                ->remove('lastName')
                ->remove('username')
                ->remove('email')
                ->remove('plainPassword');
        
        $builder->add('username', 'text', array(
                    'label' => "Username:",
                    'required' => true,
                    'attr' => array(
                        'class' => "input-large",
                    ),
                    'invalid_message' => "Please enter a username",
                ))
                ->add('email', 'email', array(
                    'label' => 'Email:',
                    'translation_domain' => 'FOSUserBundle',
                    'constraints' => array(
                        new \Symfony\Component\Validator\Constraints\Email(array(
                            "groups" => array("simple"),
                            "checkMX" => true,
                        ))
                    ),
                    'attr' => array(
                        'class' => "input-large",
                    ),
                    'invalid_message' => "Please enter an email",
                ))
                ->add('firstName', 'text', array(
                    'label' => "First Name:",
                    'required' => true,
                    'attr' => array(
                        'class' => "input-large",
                    ),
                    'invalid_message' => "Please enter a first name",
                ))
                ->add('lastName', 'text', array(
                    'label' => "Last Name:",
                    'required' => true,
                    'attr' => array(
                        'class' => "input-large",
                    ),
                    'invalid_message' => "Please enter a last name",
                ))
                ->add('plainPassword', 'repeated', array(
                    'type' => 'password',
                    'required' => true,
                    'first_options' => array(
                        'label' => "Password:"
                    ),
                    'second_options' => array(
                        'label' => "Password Comfirmation:"
                    ),
                    'attr' => array(
                        'class' => "input-medium",
                    ),
                    'invalid_message' => 'fos_user.password.mismatch',
                ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'ASU\StackBundle\Entity\Stacker'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'asu_stackbundle_stacker';
    }

}

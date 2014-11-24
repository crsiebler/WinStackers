<?php

namespace ASU\SecurityBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends \KMJ\ToolkitBundle\Form\UserType {

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        parent::setDefaultOptions($resolver);
        $resolver->setDefaults(array(
            'data_class' => 'ASU\SecurityBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'asu_securitybundle_user';
    }

}

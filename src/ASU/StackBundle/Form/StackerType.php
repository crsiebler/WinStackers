<?php

namespace ASU\StackBundle\Form;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StackerType extends \KMJ\ToolkitBundle\Form\UserType {

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

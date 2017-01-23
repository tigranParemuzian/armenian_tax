<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UploadXmlType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', 'file', array('label' => 'Chose xml', 'required' => true, 'attr' => array(
                'class' => 'btn btn-success')))
            ->add('calculate', 'submit', array('label' => 'Upload and calculate', 'attr' => array(
                'class' => 'btn btn-success')))
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getName()
    {
        return 'app_bundleupload_xml';
    }
}

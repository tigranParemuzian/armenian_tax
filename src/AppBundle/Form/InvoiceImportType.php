<?php

namespace AppBundle\Form;

use ShopBundle\Entity\InvoiceItem;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InvoiceImportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type_invoice', 'choice',
                ['choices'=>[
                    InvoiceItem::IS_NOT_GROUPED=>'Not Grouped',
                    InvoiceItem::IS_GROUPED=>'Grouped'
                ], 'label'=>'Select Type'])
            ->add('file', 'file',
                ['label' => 'Chose excel', 'required' => true, 'attr' => [
                'class' => 'btn btn-success']])
            ->add('calculate', 'submit', array('label' => 'Upload and calculate', 'attr' => array(
                'class' => 'btn btn-success')))
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getName()
    {
        return 'app_bundle_invoice_import';
    }
}

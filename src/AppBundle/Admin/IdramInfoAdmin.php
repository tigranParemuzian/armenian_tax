<?php
/**
 * Created by PhpStorm.
 * User: parem
 * Date: 1/17/17
 * Time: 1:11 PM
 */

namespace AppBundle\Admin;

use ShopBundle\Entity\CompanyCategory;
use ShopBundle\Form\AddressType;
use ShopBundle\Form\CompanyCategoryType;
use ShopBundle\Form\PersonType;
use Sonata\AdminBundle\Admin\AbstractAdmin as Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class IdramInfoAdmin extends Admin
{

    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'DESC', // sort direction
        '_sort_by' => 'id' // field name
    );

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
//            ->tab('Main')
            ->with('Main', array(
                'class' => 'col-sm-6',
                'box-class' => 'box box-solid box-danger hidden',
                'description' => 'Settings create part'
            ))
            ->add('const', 'number',  array('required' => true))
            ->add('groups')
            ->add('parentCost', 'number',  array('required' => false))
            ->add('number', 'number', array('required' => true))
            ->add('dueDate', 'sonata_type_date_picker', array(
                    'dp_side_by_side'       => false,
                    'dp_use_current'        => false,
                    'widget' => 'single_text',
                    'format' => 'y-dd-MM',
                    'required' => false,
                    'label'=>'admin.labels.payment_date',
                    'attr'=>array('style' => 'width: 100px !important'))
            )
            ->end()
        ;

    }

    /**
     * @param ListMapper $list
     */
    protected function configureListFields(ListMapper $list)
    {
        $list
            ->add('id')
            ->add('groups')
            ->addIdentifier('const')
            ->addIdentifier('parentCost')
            ->addIdentifier('number')
            ->addIdentifier('dueDate')
            ->add('_action', 'actions',
                array('actions' =>
                    array(
                        'show' => array(), 'edit' => array(), 'delete' => array())
                ));

    }

    /**
     * @param DatagridMapper $filter
     */
    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('id')
            ->add('groups')
            ->add('const')
            ->add('parentCost')
            ->add('number')
            ->add('dueDate', 'doctrine_orm_datetime_range', array('label'=>'admin.labels.payment_date'), 'sonata_type_datetime_range_picker',
                array('field_options_start' => array('format' => 'yyyy-MM-dd HH:mm:ss'),
                    'field_options_end' => array('format' => 'yyyy-MM-dd HH:mm:ss'))
            )
            ;
    }

    /**
     * @param ShowMapper $show
     */
    protected function configureShowFields(ShowMapper $show)
    {
        $show
            ->add('id')
            ->add('groups')
            ->add('const')
            ->add('parentCost')
            ->add('number')
            ->add('dueDate')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function preUpdate($object)
    {
//        $object->uploadFile();
    }

    /**
     * {@inheritdoc}
     */
    public function prePersist($object)
    {
//        $object->uploadFile();
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: parem
 * Date: 1/17/17
 * Time: 1:11 PM
 */

namespace ShopBundle\Admin;

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

class CompanyAdmin extends Admin
{

    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'DESC', // sort direction
        '_sort_by' => 'id' // field name
    );

    protected function configureFormFields(FormMapper $formMapper)
    {
        $item = $this->getSubject();

        $formMapper
//            ->tab('Main')
            ->with('Main', array(
                'class' => 'col-sm-6',
                'box-class' => 'box box-solid box-danger hidden',
                'description' => 'Settings create part'
            ))
            ->add('name', 'text', ['required' => true])
            ->add('taxCode', 'text', ['required' => false])
            ->add('webPage', 'url', ['required' => false])
            ->add('category')
            ->end()
//            ->end()
            ;
        $formMapper
//            ->tab('Address')
            ->with('Address', array(
                'class' => 'col-sm-6',
                'box-class' => 'box box-solid box-danger hidden',
                'description' => 'Settings create part'
            ))
            ->add('address', 'sonata_type_model',  array('expanded' => true))
            ->end()
//            ->end()
            ;
        $formMapper
//            ->tab('Persons')
            ->with('Persons', array(
                'class' => 'col-sm-6',
                'box-class' => 'box box-solid box-danger hidden',
                'description' => 'Settings create part'
            ))
            ->add('person', 'sonata_type_collection', array(), array(
                    'edit' => 'inline',
                    'inline' => 'list',
                    'sortable'  => 'id',
                    'delete'=>true))
            ->end()
//            ->end()
        ;

    }

    /**
     * @param ListMapper $list
     */
    protected function configureListFields(ListMapper $list)
    {
        $list
            ->add('id')
            ->addIdentifier('name')
            ->addIdentifier('taxCode')
            ->addIdentifier('webPage')
            ->addIdentifier('category')
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
            ->add('name')
            ->add('taxCode')
            ->add('webPage')
            ->add('category')
            ;
    }

    /**
     * @param ShowMapper $show
     */
    protected function configureShowFields(ShowMapper $show)
    {
        $show
            ->add('id')
            ->add('name')
            ->add('taxCode')
            ->add('webPage')
            ->add('category')
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
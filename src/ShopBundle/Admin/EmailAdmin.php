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

class EmailAdmin extends Admin
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
            ->add('email')
            ->add('isMain', 'choice', ['choices'=>[1=>'Yes', 0=>'No']])
            ;
    }

    /**
     * @param ListMapper $list
     */
    protected function configureListFields(ListMapper $list)
    {
        $list
            ->add('id')
            ->add('email')
            ->add('isMain')
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
            ->add('email')
            ->add('isMain')
            ;
    }

    /**
     * @param ShowMapper $show
     */
    protected function configureShowFields(ShowMapper $show)
    {
        $show
            ->add('id')
            ->add('email')
            ->add('isMain')
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
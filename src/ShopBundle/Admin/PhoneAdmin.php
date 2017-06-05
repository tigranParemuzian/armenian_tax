<?php
/**
 * Created by PhpStorm.
 * User: parem
 * Date: 1/17/17
 * Time: 1:11 PM
 */

namespace ShopBundle\Admin;

use ShopBundle\Entity\CompanyCategory;
use ShopBundle\Entity\Phone;
use ShopBundle\Form\AddressType;
use ShopBundle\Form\CompanyCategoryType;
use ShopBundle\Form\PersonType;
use Sonata\AdminBundle\Admin\AbstractAdmin as Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class PhoneAdmin extends Admin
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
            ->add('number', 'text', ['label'=>'Telephone number'])
            ->add('type', 'choice', ['choices'=>[Phone::IS_MOBILE=>'Mobile', Phone::IS_PHONE=>'Phone']]);
            ;
    }

    /**
     * @param ListMapper $list
     */
    protected function configureListFields(ListMapper $list)
    {
        $list
            ->add('id')
            ->add('number', null, ['label'=>'Telephone number'])
            ->add('type', 'choice', ['choices'=>[Phone::IS_MOBILE=>'Mobile', Phone::IS_PHONE=>'Phone']])
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
            ->add('number', null, ['label'=>'Telephone number'])
            ->add('type', 'choice', ['choices'=>[Phone::IS_MOBILE=>'Mobile', Phone::IS_PHONE=>'Phone']])

            ;
    }

    /**
     * @param ShowMapper $show
     */
    protected function configureShowFields(ShowMapper $show)
    {
        $show
            ->add('id')
            ->add('address')
            ->add('lat')
            ->add('lng')
            ->add('isMain','choice', ['choices'=>[1=>'On', 0=>'Off']])
            ->add('building')
            ->add('house')
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
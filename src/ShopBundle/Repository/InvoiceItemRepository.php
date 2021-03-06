<?php

namespace ShopBundle\Repository;

/**
 * InvoiceItemRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class InvoiceItemRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * This function use to find data by ides
     *
     * @param $ids
     * @return array
     */
    public function findByIdes($ids){

        return $this->getEntityManager()
            ->createQueryBuilder()
            ->select('inv')
            ->from('ShopBundle:InvoiceItem', 'inv')
            ->where('inv.id IN (:ids)')
            ->setParameter('ids', $ids)
            ->getQuery()->getResult()
            ;
    }
}

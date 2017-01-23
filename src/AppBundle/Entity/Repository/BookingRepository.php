<?php
namespace AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Created by PhpStorm.
 * User: tigran
 * Date: 1/16/17
 * Time: 2:48 AM
 */
class BookingRepository extends EntityRepository
{
    public function findListing(){
        return $this->getEntityManager()->createQueryBuilder()
        ->select('b.id, b.created, b.status, COUNT(i.id) as items_count, u.username as author')
            ->from('AppBundle:Booking', 'b')
//            ->leftJoin('b.footer', 'f')
//            ->leftJoin('b.header', 'h')
            ->leftJoin('b.user', 'u')
            ->leftJoin('b.items', 'i')
            ->where('b.id > 0')
            ->groupBy('b.id')
            ->orderBy('b.created', 'DESC')
            ->getQuery()->getResult()
        ;


    }

    public function findForMah($id){
        return $this->getEntityManager()->createQueryBuilder()
        ->select('b')
            ->from('AppBundle:Booking', 'b')
            ->leftJoin('b.footer', 'f')
            ->leftJoin('b.header', 'h')
            ->leftJoin('b.items', 'i')
            ->where('b.id =:bid')
            ->groupBy('b.id')
            ->orderBy('b.created', 'DESC')
            ->setParameter('bid', $id)
            ->getQuery()->getOneOrNullResult()
        ;


    }

}
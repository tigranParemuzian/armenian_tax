<?php
/**
 * Created by PhpStorm.
 * User: tigran
 * Date: 1/26/17
 * Time: 4:55 PM
 */

namespace ShopBundle\Controller\Rest;


use AppBundle\Entity\Locations;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use JMS\Serializer\SerializationContext;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AppBundle\Entity\Booking;
use ShopBundle\Entity\InvoiceItem;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


/**
 * Class RestMainController
 * @package AppBundle\Controller\Rest
 *
 * @RouteResource("Tax")
 * @Rest\Prefix("/api")
 * @Rest\NamePrefix("rest_")
 */
class RestMainController extends FOSRestController
{

    /**
     * This function return bag info
     *
     * @ApiDoc(
     *  resource=true,
     *  section="Tax",
     *  description="This function is used to get a all Articles.",
     *  statusCodes={
     *         200="Returned when successful",
     *     }
     * )
     * @Rest\View()
     */
    public function getCodesAction(Request $request, $row)
    {
        $currentUser = $this->getUser();
        // check isset user and user security role
        if(!is_object($currentUser)) {
            $translated = $this->get('translator')->trans('erorrs.user.not_found');
            return new JsonResponse($translated , Response::HTTP_FORBIDDEN);
        }

        $em = $this->getDoctrine()->getManager();

        // get projectChartfield by project id
        $bookings = $em->getRepository('ShopBundle:CacheCodes')->findInfo($row);

        if(!$bookings){
            return new JsonResponse('0 bookings' , Response::HTTP_NOT_FOUND);
        }
        return $bookings;
    }

    /**
     * This function return bag info
     *
     * @ApiDoc(
     *  resource=true,
     *  section="Tax",
     *  description="This function is used to get a all Articles.",
     *  statusCodes={
     *         200="Returned when successful",
     *     }
     * )
     * @Rest\View()
     */
    public function getLocatinAction(Request $request,  $lat, $log)
    {
        $em = $this->getDoctrine()->getManager();

        $location = new Locations();
        $location->setLat($lat);
        $location->setLog($log);

        $em->persist($location);
        $em->flush();

        return new JsonResponse('Tk', Response::HTTP_OK);
    }

    /**
     *
     * @ApiDoc(
     *  resource=true,
     *  section="Tax",
     *  description="This function is used to create bag .",
     *  statusCodes={
     *         202="Returned when find",
     *         404="Return when user location not found", },
     *     parameters={
     *          {"name"="slug", "dataType"="string", "required"=true, "description"="slug"},
     *          {"name"="count", "dataType"="string", "required"=true, "description"="count"},
     *      }
     * )
     *
     * This function is used to booking
     * @Rest\View()
     *
     */
    public function postCodesAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $em = $this->getDoctrine()->getManager();

        $ids = [];
        $newData = [];
        foreach ($data as $item){

             if($item['id']){

                 $ids[] = $item['id'];
                 $newData[$item['id']]= $item;
                 $lastId = $item['id'];
             }
        }

        $items = $em->getRepository('ShopBundle:CacheCodes')->findUpdated($ids);

        $i = 0;
        foreach ($items as $it){
            $it->setName($newData[$it->getId()]['name']);
            $em->persist($it);
            $i ++;
            if($i%1000===0){
                $em->flush();
            }

        }
        $em->flush();

        return ['id'=>$lastId];
    }

    /**
     *
     * @ApiDoc(
     *  resource=true,
     *  section="Tax",
     *  description="This function is used to add group data .",
     *  statusCodes={
     *         202="Returned when find",
     *         404="Return when user location not found", },
     *     parameters={
     *          {"name"="name", "dataType"="string", "required"=true, "description"="name"},
     *          {"name"="ides", "dataType"="array", "required"=true, "description"="ides"},
     *      }
     * )
     *
     * This function is used to booking
     * @Rest\View()
     *
     */
    public function postAddGoupAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $em = $this->getDoctrine()->getManager();

        $data['name'] ? $name = $data['name'] : $name = null;
        $data['ides'] ? $ids = $data['ides'] : $ids = null;

        if(!$name || count($ids)<1) {

            return new JsonResponse('Invalid Data', 400);
        }

        $items = $em->getRepository('ShopBundle:InvoiceItem')->findByIdes($ids);

        if(!$items){
            return new JsonResponse('Items not found', 404);
        }

        $count = 0;
        $price = 0;
        $netto = 0;
        $brutto = 0;
        $package = 0;
        $description = '';
        $parents = [];
        foreach ($items as $item){
            if($item instanceof InvoiceItem){

                $parents[] = ['id'=>$item->getId(), 'name'=>$item->getName()];
                $count += $item->getCount();
                $price += $item->getPrice();
                $netto += $item->getNetto();
                $brutto += $item->getBrutto();
                $package += $item->getPackage();
                $item->getDescription() ? $description = $item->getDescription() : '';
                $item->getUnit() ? $unit = $item->getUnit() : '';
                $item->getCurency() ? $curency = $item->getCurency() : '';

                $item->setState(InvoiceItem::IS_INACTIVE);

            }
        }

        $newGroup = new InvoiceItem();

        $newGroup->setName($name);
        $newGroup->setParents($parents);
        $newGroup->setCount($count);
        $newGroup->setPrice($price);
        $newGroup->setNetto($netto);
        $newGroup->setBrutto($brutto);
        $newGroup->setPackage($package);
        $newGroup->setDescription($description);
        $newGroup->setSinglePrice($price/$count);
        $newGroup->setInvoice($items[0]->getInvoice());

        $em->persist($newGroup);

        $em->flush();

        return ['newGroup'=>$newGroup, 'parents'=>$items];

        return $data['ides'];
        $items = $em->getRepository('ShopBundle:CacheCodes')->findUpdated($ids);

        $i = 0;
        foreach ($items as $it){
            $it->setName($newData[$it->getId()]['name']);
            $em->persist($it);
            $i ++;
            if($i%1000===0){
                $em->flush();
            }

        }
        $em->flush();

        return ['id'=>$lastId];
    }
}
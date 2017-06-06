<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AttachedDocument;
use AppBundle\Entity\Booking;
use AppBundle\Entity\Footer;
use AppBundle\Entity\Header;
use AppBundle\Entity\Item;
use AppBundle\Entity\Reference;
use AppBundle\Entity\ReferenceItem;
use AppBundle\Entity\Tarification;
use AppBundle\Form\UploadXmlType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Validator\Constraints\Date;

class MainController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template
     * @Security("has_role('ROLE_USER')")
     */
    public function indexAction()
    {
        return array('sss');
    }

    /**
     * @Route("/create-reference", name="create-reference")
     * @param Request $request
     * @return Response
     * @Security("has_role('ROLE_USER')")
     */
    public function uploadAction(Request $request){

        $form = $this->createForm(new UploadXmlType());

        $em = $this->getDoctrine()->getManager();
        $message = array('success'=>'', 'errorMessage'=>'');
        // determination file types
        $xlsTypes = $this->xlsTypes();
        // check form submit
        if($request->isMethod('POST')) {

            // get request & check
            $form->handleRequest($request);
            //check form validation
            if ($form->isValid()) {

                $fs = new Filesystem();

                $brochuresDir = $this->container->getParameter('kernel.root_dir') . '/../web/uploads/files';

                $userDir = $brochuresDir. '/'.str_replace('.', '', str_replace('/', '_', $this->getUser()->getUsername()));
                $fs->mkdir($userDir);

                // form get date
                $data = $form->getData();
                $file = $data['file'];
                $name = 'data';
                // corrections of uploaded file name because is sended from cli
                $fileName = $name.(str_replace( ' ', '_', str_replace('(', '_', str_replace(')', '_', $file->getClientOriginalName()))));
                // save file in /web/uploads/files folder
                $brochuresDir = $this->container->getParameter('kernel.root_dir').'/../web/uploads/files';
                //get corrent user
                $now = new \DateTime('now');
                // check isset file, file type is xls
                if (is_file($file) && in_array($file->getMimeType(), $xlsTypes))
                {
                    // move file to uploda directory
                    $file->move($userDir, $fileName);

                    $file = $userDir.'/'.$fileName;

//                    $fs->chown($userDir.'/'.$fileName, 'www-data', true);

                    if(true)
                    {
                        $fileContents = file_get_contents($file);

                        $fileContents = str_replace('ESADout_CU:', '', $fileContents);
                        $fileContents = str_replace('catESAD_cu:', '', $fileContents);
                        $fileContents = str_replace('cat_ru:', '', $fileContents);

                        $xml = new \SimpleXMLElement($fileContents);

                        $reference = new Reference();
                        $reference->setUser($this->getUser());
                        $reference->setCode($now->getTimestamp().$this->getUser()->getId());
                        $em->persist($reference);

                        foreach ($xml as $t){

                            if(isset($t->ESADout_CUMainContractTerms) && count($t->ESADout_CUMainContractTerms) >0){
                                $currencyCode = $t->ESADout_CUMainContractTerms->ContractCurrencyCode;
                                $currencyRate = $t->ESADout_CUMainContractTerms->ContractCurrencyRate;
                            }

                            if(isset($t->ESADout_CUConsignor) && count($t->ESADout_CUConsignor) >0){
                                $companyFrom = $t->ESADout_CUConsignor->OrganizationName;
                            }

                            if(isset($t->ESADout_CUConsignee) && count($t->ESADout_CUConsignee) >0){
                                $companyName = $t->ESADout_CUConsignee->OrganizationName;
                            }

                            if(isset($t->ESADout_CUGoods) && count($t->ESADout_CUGoods)>0){

                                foreach ($t->ESADout_CUGoods as $i){

                                    $referenceItem = new ReferenceItem();
                                    $referenceItem->setCode((string)$this->checkInfo($i->GoodsTNVEDCode));
                                    $referenceItem->setName((string)$this->checkInfo($i->GoodsDescription));
                                    $referenceItem->setNameRu((string)$this->checkInfo($i->goodsDscRu));
                                    $referenceItem->setBrutto((float)$this->checkInfo($i->GrossWeightQuantity));
                                    $referenceItem->setNetto((float)$this->checkInfo($i->NetWeightQuantity));
                                    $referenceItem->setPrice((float)$this->checkInfo($i->InvoicedCost));
                                    $referenceItem->setTaxPrice((float)$this->checkInfo($i->ESADout_CUCustomsPaymentCalculation->TaxBase));
                                    $referenceItem->setParentCode((string)$this->checkInfo($i->GoodsAddTNVEDCode));
                                    $referenceItem->setCountryCode((string)$this->checkInfo($i->OriginCountryCode));
                                    $referenceItem->setCountryName((string)$this->checkInfo($i->OriginCountryName));
                                    $referenceItem->setCount((float)$this->checkInfo($i->SupplementaryGoodsQuantity->GoodsQuantity));
                                    $referenceItem->setPakageQuantity((float)$this->checkInfo($i->ESADGoodsPackaging->PakageQuantity));
                                    $referenceItem->setUnitName((string)$this->checkInfo($i->SupplementaryGoodsQuantity->MeasureUnitQualifierName));
                                    $referenceItem->setUnitCode((float)$this->checkInfo($i->SupplementaryGoodsQuantity->MeasureUnitQualifierCode));
                                    $referenceItem->setCurrencyName((string)$currencyCode);
                                    $referenceItem->setCurrencyRate((float)$this->checkInfo($currencyRate));
                                    $referenceItem->setCompanyName((string)$this->checkInfo($companyName));
                                    $referenceItem->setCompanyFrom((string)$this->checkInfo($companyFrom));
                                    $referenceItem->setCalcByWeight($referenceItem->getTaxPrice() / $referenceItem->getCurrencyRate() / $referenceItem->getNetto());
                                    $referenceItem->setCalcByCount($referenceItem->getTaxPrice() / $referenceItem->getCurrencyRate() / $referenceItem->getCount());
                                    $referenceItem->setReference($reference);

                                    $validator = $this->get('validator');

                                    $errors = $validator->validate($referenceItem);

                                    if(count($errors) > 0 ) {

                                    }

                                    try{
                                        $em->persist($referenceItem);
                                    }catch (\Exception $e){

                                    }

                                }
                            }
                        }

                        $em->flush();

                        $message['success'] = 'success';

                        if(isset($message['errorMessage']))
                        {
                            $this->addFlash(
                                'error',
                                $message['errorMessage']
                            );
                        }

                        if (isset($message['success']))
                        {
                            $this->addFlash(
                                'success',
                                $message['success']
                            );
                        }

                        return $this->redirectToRoute('reference-list');
                    }
                }
                elseif (is_file($brochuresDir.'/'.$fileName)) {
                    unlink($brochuresDir.'/'.$fileName);

                    $this->addFlash(
                        'error',
                        'Brochure file not exist or file extension not xls. Please connect to administration.'
                    );
                }
                else {

                    $this->addFlash(
                        'error',
                        'Brochure file not exist or file extension not xls. Please connect to administration.'
                    );
                }

            }
        }

        return $this->render('AppBundle:Upload:upload_file.html.twig', array(
            'form' => $form->createView(), 'status'=>$message['success']));
    }

    /**
     * @Route("/list", name="list")
     * @param Request $request
     * @return Response
     * @Security("has_role('ROLE_USER')")
     * @Template()
     */
    public function listAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $bookings = $em->getRepository('AppBundle:Booking')->findListing();

        return array('bookings'=>$bookings);
    }



    /**
     * @Route("/reference/list", name="reference-list")
     * @param Request $request
     * @return Response
     * @Security("has_role('ROLE_USER')")
     */
    public function referenceAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $reference = $em->getRepository('AppBundle:Reference')->findByUser($this->getUser()->getId());


        if (!$reference){
            $this->addFlash(
                'error',
                'Reference not found.'
            );

            return $this->redirectToRoute('create-reference');
        }

        return $this->render('AppBundle:Main:reference.html.twig', array('data'=>$reference));
    }


    /**
     *
     * @Route("/reference/generate-excel/{referenceId}/{state}", name="reference-generate-excel")
     * @param Request $request
     * @return Response
     * @Security("has_role('ROLE_USER')")
     *
     * @param Request $request
     * @param $referenceId
     */
    public function generateExcel(Request $request, $referenceId, $state){

        $em = $this->getDoctrine()->getManager();

        $data = $em->getRepository('AppBundle:ReferenceItem')->findByReference((int)$referenceId);

        if(!$data){
            $this->addFlash(
                'error',
                'Reference Items not found.'
            );

            return $this->redirectToRoute('reference-list');
        }

        $file = $this->get('app.convert.excel')->createReference($data, $state);

        $response = new Response();
        $response->headers->set('Cache-Control', 'private');
        $response->headers->set('Content-type', mime_content_type($file));
        $response->headers->set('Content-Disposition', 'attachment; filename="' . basename($file) . '";');
        $response->headers->set('Content-length', filesize($file));

        $response->sendHeaders();

        $response->setContent(file_get_contents($file));

        return $response;


    }


    /**
     * @Route("/reference/list", name="reference-list")
     * @param Request $request
     * @return Response
     * @Security("has_role('ROLE_USER')")
     */
//    public function generateMahAction(Request $request){
//
//        $em = $this->getDoctrine()->getManager();
//
//        $reference = $em->getRepository('AppBundle:Reference')->findByUser($this->getUser()->getId());
//
//
//        if (!$reference){
//            $this->addFlash(
//                'error',
//                'Reference not found.'
//            );
//
//            return $this->redirectToRoute('create-reference');
//        }
//
//        return $this->render('', ['data'=>$reference]);
//        dump($reference); exit;
//
//
//
//
//
////        $this->generateMah($bookings, $state);
///*//        dump($bookings);
//        foreach($bookings->getItems() as $item){
////            dump($item); exit;
//        }*/
//
//        return $this->redirect($this->generateUrl('list'));
//    }
    /**
     * This function check import file type
     * @return array
     */
    private function xlsTypes()
    {
        $xlsTypes = array('application/xml',
            'applic ation/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/vnd.ms-office',
            'application/vnd.ms-excel');

        return $xlsTypes;
    }

    private function checkInfo($info){

        if(strlen($info)>0){
            return $info;
        }else{
            return null;
        }
    }

    private function generateMah($booking, $state){

        if($booking instanceof Booking){

            $mah = '<?xml version="1.0" encoding="UTF-8"?><dts>
                  <gtdNumber_CustomsCode>' . $booking->getHeader()->getIdentTaxCode() . '</gtdNumber_CustomsCode>
                  <gtdNumber_CustomsName>ՄՃՓ Տ/Մ</gtdNumber_CustomsName>
                  <gtdNumber_CustomsNameRus>Региональная таможня международных перевозок</gtdNumber_CustomsNameRus>
                  <gtdNumber_CustomsNameEng>International Road Transportation RCH</gtdNumber_CustomsNameEng>
                  <formDts>DTS1</formDts>
                  <customsCostMethodCode>METHOD_1</customsCostMethodCode>
                  <baseMethodCode/>
                  <additionalSheetNumber>10</additionalSheetNumber>
                  <currencyCode>' . $booking->getHeader()->getValuationGsInvoiceCurrencyCode() .'</currencyCode>
                  <currencyName>ԱՄՆ դոլար</currencyName>
                  <currencyNameRus>Доллары США</currencyNameRus>
                  <currencyNameEng>United States Dollar</currencyNameEng>
                  <currencyDate>' . $booking->getHeader()->getSerialCDate()->format('Y-m-d') . '</currencyDate>
                  <currencyRate>' . $booking->getHeader()->getValuationGsInvoiceCurrencyRate() .'</currencyRate>
                  <iff>JURIDICAL</iff>';
            /*'
                  <dtsInvoiceDocuments>
                    <dtsInvoiceDocument>
                      <invoicePosition>NUMBER_6</invoicePosition>
                      <prDocumentName>Փոխադրման ամփոփագիր</prDocumentName>
                      <presentedDocumentModeCode>460</presentedDocumentModeCode>
                      <prDocumentNumber>9707</prDocumentNumber>
                      <prDocumentDate>2016-12-16</prDocumentDate>
                    </dtsInvoiceDocument>
                  </dtsInvoiceDocuments>';*/
            $mah.='<deliveryTerms>
                    <deliveryTerm>
                      <deliveryTermsStringCode>' . $booking->getHeader()->getTransportDeliveryTermCode() .'</deliveryTermsStringCode>
                      <transferPlace>' . $booking->getHeader()->getTransportDeliveryTermCode() .'</transferPlace>
                    </deliveryTerm>
                  </deliveryTerms>
                  <dTSBuyerSellerDependence>
                    <column7A>NO</column7A>
                    <column7B>NO</column7B>
                    <column7C/>
                    <column7CDscs/>
                  </dTSBuyerSellerDependence>
                  <dTSSellingLimitation>
                    <column8A>NO</column8A>
                    <column8B>NO</column8B>
                    <limitationDscs/>
                  </dTSSellingLimitation>
                  <dTSAdditionalPayment>
                    <column9A>NO</column9A>
                    <column9B>NO</column9B>
                    <paymentDscs/>
                    <paymentConditionDscs/>
                  </dTSAdditionalPayment>
                  <reasonApplyMethods/>
                  <items>';
            $mahItem = '';
            foreach($booking->getItems() as $item){
//                if($item instanceof Item){

                    $mahItem .='
                    <item>
                      <grossWeightQuantity>' . $item->getGrossWeightItm() . '</grossWeightQuantity>
                      <goodsTNVEDCode>'. $item->getTarification()->getHScodeCommodityCode(). $item->getTarification()->getHScodePrecision1() .'</goodsTNVEDCode>
                      <goodsAddTNVEDCode>'.$item->getTarification()->getHScodePrecision4() .'</goodsAddTNVEDCode>                    
                      <methodNumberCode>METHOD_1</methodNumberCode>
                      <baseNumberCode/>
                      <methodChoice/>
                      <nationalDeclaredCustomsCost>'.$item->getTotalCifItm().'</nationalDeclaredCustomsCost>
                      <dollarDeclaredCustomsCost>145.88</dollarDeclaredCustomsCost>
                      ';

                    if((int)$state == 1){
                        $mahItem .='<additionalDataList/>
                        <currencyPaymentList>
                        <currencyPayment>
                          <positionNumber>' . $item->getItemNumber() . '</positionNumber>
                          <currencyAmount>' . $item->getTarification()->getItemPrice() . '</currencyAmount>
                          <currencyCode>' . $booking->getHeader()->getValuationGsInvoiceCurrencyCode() .'</currencyCode>
                          <currencyRate>' . $booking->getHeader()->getValuationGsInvoiceCurrencyRate() .'</currencyRate>
                        </currencyPayment>
                      </currencyPaymentList>';
                    }


                $mahItem .='<dtsMethod1>
                        <dealCurrencyAmount>' . $item->getTarification()->getItemPrice() . '</dealCurrencyAmount>
                        <dealCurrencyCode>' . $booking->getHeader()->getValuationGsInvoiceCurrencyCode() .'</dealCurrencyCode>
                        <dealCurrencyRate>' . $booking->getHeader()->getValuationGsInvoiceCurrencyRate() .'</dealCurrencyRate>
                        <dealNationalAmount>65451</dealNationalAmount>
                        <basisNationalAmount>65451</basisNationalAmount>
                        <indirectNationalPayment/>
                        <indirectCurrencyCode/>
                        <indirectCurrencyRate/>
                        <agentBonus/>
                        <packageExpanses/>
                        <storeCost1/>
                        <productionToolkitCost1/>
                        <workingStockCost/>
                        <designPayment1/>
                        <intellectualPropertyPayment/>
                        <sellerIncome/>
                        <borderTransportCharges1>'.$item->getAmountNationalCurrency().'</borderTransportCharges1>
                        <loadCharges1/>
                        <additionalSumBorderPlace/>
                        <insuranceCharges1/>
                        <totalAdditionalSum>'.$item->getAmountNationalCurrency().'</totalAdditionalSum>
                        <buildingAmount/>
                        <unionTransportCharge1/>
                        <unionTaxPayment1/>
                        <totalDeductionAmount1>0</totalDeductionAmount1>
                      </dtsMethod1>
                    </item>';
//                }

            }


            $mah .=$mahItem;

            $mah.='</items>
                  <dtSoutBuyer>
                    <buyerUnn>06938022</buyerUnn>
                    <buyerOrganizationName>«Վանարմկոմպ» ՍՊԸ</buyerOrganizationName>
                    <buyerStreetHouse>Կնունյանց փող. թիվ 43</buyerStreetHouse>
                    <buyerPostalCode/>
                    <buyerCountryCode/>
                    <buyerRegion/>
                    <buyerStreetHouse>Կնունյանց փող. թիվ 43</buyerStreetHouse>
                    <buyerIdentityCardName/>
                    <buyerIdentityCardNumber/>
                    <buyerIdentityCardDate/>
                    <buyIdOrganizationName/>
                  </dtSoutBuyer>
                  <dtSoutSeller>
                    <sellerOrganizationName>' . $booking->getHeader()->getTraderstaxExport() . '</sellerOrganizationName>
                    <sellerPostalCode/>
                    <sellerCountryCode>NL</sellerCountryCode>
                    <sellerCountryName>Նիդեռլանդներ</sellerCountryName>
                    <sellerCountryNameRus>Королевство Нидерландов</sellerCountryNameRus>
                    <sellerCountryNameEng>Netherlands</sellerCountryNameEng>
                    <sellerRegion/>
                    <sellerCity>Almere</sellerCity>
                    <sellerStreetHouse>Vittevrouwen56</sellerStreetHouse>
                    <sellerIdentityCardName/>
                    <sellerIdentityCardNumber/>
                    <sellerIdentityCardDate/>
                    <sellIdOrganizationName/>
                  </dtSoutSeller>
                  <dtSoutDeclarant>
                    <declarantUnn>' . $booking->getHeader()->getTraderstypeCosigCode() . '</declarantUnn>
                    <declarantOrganizationName>«Վանարմկոմպ» ՍՊԸ</declarantOrganizationName>
                    <declarantPostalCode/>
                    <declarantCountryCode/>
                    <declarantRegion/>
                    <declarantCity>ք.Վանաձոր</declarantCity>
                    <declarantStreetHouse>Կնունյանց փող. թիվ 43</declarantStreetHouse>
                    <declarantIdentityCardName/>
                    <declarantIdentityCardNumber/>
                    <declarantIdentityCardDate/>
                    <decIdOrganizationName/>
                  </dtSoutDeclarant>
                </dts>
';

        }

        $fileName = 'mah_' . str_replace(' ', '_', str_replace('.', '_', $booking->getId()));

        $fs = new Filesystem();
        $fs->touch($this->container->getParameter('kernel.root_dir')."/../web/uploads/files/$fileName.xml");
        $fs->dumpFile($this->container->getParameter('kernel.root_dir')."/../web/uploads/files/$fileName.xml", $mah);

    }
}

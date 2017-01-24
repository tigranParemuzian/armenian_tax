<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AttachedDocument;
use AppBundle\Entity\Booking;
use AppBundle\Entity\Footer;
use AppBundle\Entity\Header;
use AppBundle\Entity\Item;
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
     * @Route("/upload", name="upload")
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

                // form get date
                $data = $form->getData();
                $file = $data['file'];
                $name = 'data';
                // corrections of uploaded file name because is sended from cli
                $fileName = $name.(str_replace( ' ', '_', str_replace('(', '_', str_replace(')', '_', $file->getClientOriginalName()))));
                // save file in /web/uploads/files folder
                $brochuresDir = $this->container->getParameter('kernel.root_dir').'/../web/uploads/files';
                $mainDir = str_replace('/app', '/', $this->container->getParameter('kernel.root_dir'));
                //get corrent user
                $username = $this->getUser()->getUsername();
                // check isset file, file type is xls
                if (is_file($file) && in_array($file->getMimeType(), $xlsTypes))
                {
                    // move file to uploda directory
                    $file->move($brochuresDir, $fileName);

                    $file = $brochuresDir.'/'.$fileName;

                    if(true)
                    {
                        $fileContents = file_get_contents($file);
                        $xml = new \SimpleXMLElement($fileContents);

                        $booking = new Booking();
                        $booking->setStatus(1);
                        $booking->setUser($this->getUser());
                        $booking->setCreated(new \DateTime('now'));
                        $booking->setUpdated(new \DateTime('now'));
                        $em->persist($booking);

                        $header = new Header();
                        $header->setBooking($booking);
                        $header->setIdentTaxCode($this->checkInfo($xml->Identification->Office_segment->Customs_clearance_office_code));
                        $header->setIdentTypeCode($this->checkInfo($xml->Identification->Type->Declaration_gen_procedure_code));
                        $header->setIdentTypeDeclar($this->checkInfo($xml->Identification->Type->Type_of_declaration));
                        $header->setSerialCDate(new \DateTime($this->checkInfo($xml->Identification->Registration->Date)));
                        $header->setTransportBorderOfficeCode($this->checkInfo($xml->Transport->Border_office->Code));
                        $header->setTransportDeliveryTermCode($this->checkInfo($xml->Transport->Delivery_terms->Code));
                        $header->setTransportDeliveryTermPlace($this->checkInfo($xml->Transport->Delivery_terms->Place));
                        $header->setTransportInlandTransportMode($this->checkInfo($xml->Transport->Means_of_transport->Border_information->Inland_mode_of_transport));
                        $header->setTransportTransportIdentity($this->checkInfo($xml->Transport->Means_of_transport->Border_information->Identity));
                        $header->setTransportTransportNation($this->checkInfo($xml->Transport->Means_of_transport->Border_information->Nationality));
                        $header->setTransportTransportMode($this->checkInfo($xml->Transport->Means_of_transport->Border_information->Mode));
                        $header->setValuationGsInvoiceCurrencyCode($this->checkInfo($xml->Valuation->Gs_Invoice->Currency_code));
                        $header->setValuationGsInvoiceCurrencyRate($this->checkInfo($xml->Valuation->Gs_Invoice->Currency_rate));
                        $header->setValuationGsInvoiceTotalInvoice($this->checkInfo($xml->Valuation->Total->Total_invoice));
                        $header->setValuationGsInvoiceTotalWeight($this->checkInfo($xml->Valuation->Total->Total_weight));
                        $header->setGiTaxCountry($this->checkInfo($xml->General_information->Country->Trading_country));
                        $header->setGiTypeDestinationCode($this->checkInfo($xml->General_information->Country->Destination->Destination_country_code));
                        $header->setGiTypeExport($this->checkInfo($xml->General_information->Country->Export->Export_country_code));
                        $header->setGiTypeExportCname($this->checkInfo($xml->General_information->Country->Export->Export_country_name));
                        $header->setTraderstaxExport($this->checkInfo($xml->Traders->Exporter->Exporter_name));
                        $header->setTraderstypeCosigCode($this->checkInfo($xml->Traders->Consignee->Consignee_code));
                        $em->persist($header);

                        $j=1;
                        foreach($xml->Item as $itemInfo){
                            if(isset($itemInfo->Goods_description->Description_of_goods) && strlen($itemInfo->Goods_description->Description_of_goods)>0){
                                $item = new Item();

                                $item->setBooking($booking);
                                if(is_object($itemInfo->Packages) && count($itemInfo->Packages)>0){
                                    $item->setNumberOfPackages($this->checkInfo($itemInfo->Packages->Number_of_packages));
                                    $item->setKindOfPackagesCode($this->checkInfo($itemInfo->Packages->Kind_of_packages_code));
                                    $item->setKindOfPackagesName($this->checkInfo($itemInfo->Packages->Kind_of_packages_name));
                                }

                                $item->setCountryOfOriginCode($this->checkInfo($itemInfo->Goods_description->Country_of_origin_code));
                                $item->setSpecificationCodeDescription($this->checkInfo($itemInfo->Goods_description->Specification_Code_Description));
                                $item->setDescriptionOfGoods($this->checkInfo($itemInfo->Goods_description->Description_of_goods));
                                $item->setGrossWeightItm($this->checkInfo($itemInfo->Valuation_item->Weight_itm->Gross_weight_itm));
                                $item->setNetWeightItm($this->checkInfo($itemInfo->Valuation_item->Weight_itm->Net_weight_itm));
                                $item->setRateOfAdjustement($this->checkInfo($itemInfo->Valuation_item->Rate_of_adjustement));
                                $item->setStatisticalValue($this->checkInfo($itemInfo->Valuation_item->Statistical_value));
                                $item->setSummaryDeclaration($this->checkInfo($itemInfo->Previous_doc->Summary_declaration));
                                $item->setTotalCifItm($this->checkInfo($itemInfo->Valuation_item->Total_CIF_itm));
                                $item->setTotalCostItm($this->checkInfo($itemInfo->Valuation_item->Total_cost_itm));
                                $item->setItemNumber($j);


                                $em->persist($item);


                                if(count($itemInfo->Attached_documents)>0){
                                    $attachedDocument = new AttachedDocument();
                                    $attachedDocument->setCode($this->checkInfo($xml->Item->Attached_documents->Attached_document_code));
                                    $attachedDocument->setDate(new \DateTime($this->checkInfo($xml->Item->Attached_documents->Attached_document_date)));
                                    $attachedDocument->setItem($item);
                                    $attachedDocument->setName($this->checkInfo($xml->Item->Attached_documents->Attached_document_name));
                                    $attachedDocument->setReference($this->checkInfo($xml->Item->Attached_documents->Attached_document_reference));
                                    $attachedDocument->setScan($this->checkInfo($xml->Item->Attached_documents->Attached_document_scan));

                                    $em->persist($attachedDocument);
                                }

                                if(count($itemInfo->Tarification)>0 && count($itemInfo->Tarification->HScode)>0){
                                    $tarification = new Tarification();
                                    $tarification->setItem($item);
                                    $tarification->setHScodeCommodityCode($this->checkInfo($itemInfo->Tarification->HScode->Commodity_code));
                                    $tarification->setHScodePrecision1($this->checkInfo($itemInfo->Tarification->HScode->Precision_1));
                                    $tarification->setHScodePrecision2($this->checkInfo($itemInfo->Tarification->HScode->Precision_2));
                                    $tarification->setHScodePrecision3($this->checkInfo($itemInfo->Tarification->HScode->Precision_3));
                                    $tarification->setHScodePrecision4($this->checkInfo($itemInfo->Tarification->HScode->Precision_4));
                                    $tarification->setSupplementaryUnitCode($this->checkInfo($itemInfo->Tarification->Supplementary_unit[0]->Supplementary_unit_code));
                                    $tarification->setSupplementaryUnitName($this->checkInfo($itemInfo->Tarification->Supplementary_unit[0]->Supplementary_unit_name));
                                    $tarification->setSupplementaryUnitQuantity($this->checkInfo($itemInfo->Tarification->Supplementary_unit[0]->Supplementary_unit_quantity));
                                    $tarification->setAttachedDocItem($this->checkInfo($itemInfo->Tarification->Attached_doc_item));
                                    $tarification->setExtendedCustomsProcedure($this->checkInfo($itemInfo->Tarification->Extended_customs_procedure));
                                    $tarification->setNationalCustomsProcedure($this->checkInfo($itemInfo->Tarification->National_customs_procedure));
                                    $tarification->setPreferenceCode($this->checkInfo($itemInfo->Tarification->Preference_code));
                                    $tarification->setQuotaCode($this->checkInfo($itemInfo->Tarification->Quota_code));
                                    $tarification->setValueItem($this->checkInfo($itemInfo->Tarification->Value_item));
                                    $tarification->setValuationMethodCode($this->checkInfo($itemInfo->Tarification->Valuation_method_code));
                                    $tarification->setItemPrice($this->checkInfo($itemInfo->Tarification->Item_price));
                                    $tarification->setItemPrice($this->checkInfo($itemInfo->Tarification->Item_price));
                                    $em->persist($tarification);
                                }

                            }

                            $j++;
                        }
                        $footer = new Footer();
                        foreach($xml->Customs_Fee as $items){
                            $i = 0;
                            foreach($items[0] as $item){
                                switch($i){
                                    case 0:
                                        $footer->setFeeAmount1($this->checkInfo($item->Fee_Amount));
                                        break;
                                    case 1:
                                        $footer->setFeeAmount2($this->checkInfo($item->Fee_Amount));
                                        break;
                                    case 2:
                                        $footer->setFeeAmount3($this->checkInfo($item->Fee_Amount));
                                        break;
                                    case 3:
                                        $footer->setFeeAmount4($this->checkInfo($item->Fee_Amount));
                                        break;
                                    case 4:
                                        $footer->setFeeAmount5($this->checkInfo($item->Fee_Amount));
                                        break;
                                    case 5:
                                        $footer->setFeeAmount6($this->checkInfo($item->Fee_Amount));
                                        break;
                                    case 6:
                                        $footer->setFeeAmount7($this->checkInfo($item->Fee_Amount));
                                        break;
                                    default:
                                        break;
                                }
                                $i++;
                            }
                        }
                            $footer->setBooking($booking);

                            $em->persist($footer);
//                        }


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
     * @Route("/mah/{bid}", name="mah")
     * @param Request $request
     * @return Response
     * @Security("has_role('ROLE_USER')")
     */
    public function generateMahAction(Request $request, $bid){

        $em = $this->getDoctrine()->getManager();

        $bookings = $em->getRepository('AppBundle:Booking')->findForMah((int)$bid);
        $this->generateMah($bookings);
/*//        dump($bookings);
        foreach($bookings->getItems() as $item){
//            dump($item); exit;
        }*/

        return $this->redirect($this->generateUrl('list'));
    }
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

    private function generateMah($booking){

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
                      <goodsAddTNVEDCode/>
                      <methodNumberCode>METHOD_1</methodNumberCode>
                      <baseNumberCode/>
                      <methodChoice/>
                      <nationalDeclaredCustomsCost>70413</nationalDeclaredCustomsCost>
                      <dollarDeclaredCustomsCost>145.88</dollarDeclaredCustomsCost>
                      <additionalDataList/>
                      <currencyPaymentList>
                        <currencyPayment>
                          <positionNumber>' . $item->getItemNumber() . '</positionNumber>
                          <currencyAmount>' . $item->getTarification()->getItemPrice() . '</currencyAmount>
                          <currencyCode>' . $booking->getHeader()->getValuationGsInvoiceCurrencyCode() .'</currencyCode>
                          <currencyRate>' . $booking->getHeader()->getValuationGsInvoiceCurrencyRate() .'</currencyRate>
                        </currencyPayment>
                      </currencyPaymentList>
                      <dtsMethod1>
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
                        <borderTransportCharges1>4962</borderTransportCharges1>
                        <loadCharges1/>
                        <additionalSumBorderPlace/>
                        <insuranceCharges1/>
                        <totalAdditionalSum>4962</totalAdditionalSum>
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

        /*$fileName = 'exsp.xml';
        $brochuresDir = $this->container->getParameter('kernel.root_dir').'/../web/uploads/files';
        $mainDir = str_replace('/app', '/', $this->container->getParameter('kernel.root_dir'));
        //get corrent user
        $username = $this->getUser()->getUsername();
        // check isset file, file type is xls
//        if (is_file($file) && in_array($file->getMimeType(), $xlsTypes))
//        {
            // move file to uploda directory
            $file->move($brochuresDir, $fileName);

            $file = $brochuresDir.'/'.$fileName;
        $kernel = $container->getService('kernel');
        $path = $kernel->locateResource('@AdmeDemoBundle/path/to/file/Foo.txt');*/

    }
}

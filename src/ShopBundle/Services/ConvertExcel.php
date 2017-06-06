<?php

namespace ShopBundle\Services;
use ShopBundle\Entity\CacheCodes;
use ShopBundle\Entity\Invoice;
use ShopBundle\Entity\InvoiceItem;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Created by PhpStorm.
 * User: tigran
 * Date: 5/19/17
 * Time: 11:46 PM
 */
class ConvertExcel
{

    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }


    function ordutf8($string, &$offset) {
        $code = ord(substr($string, $offset,1));
        if ($code >= 128) {        //otherwise 0xxxxxxx
            if ($code < 224) $bytesnumber = 2;                //110xxxxx
            else if ($code < 240) $bytesnumber = 3;        //1110xxxx
            else if ($code < 248) $bytesnumber = 4;    //11110xxx
            $codetemp = $code - 192 - ($bytesnumber > 2 ? 32 : 0) - ($bytesnumber > 3 ? 16 : 0);
            for ($i = 2; $i <= $bytesnumber; $i++) {
                $offset ++;
                $code2 = ord(substr($string, $offset, 1)) - 128;        //10xxxxxx
                $codetemp = $codetemp*64 + $code2;
            }
            $code = $codetemp;
        }
        $offset += 1;
        if ($offset >= strlen($string)) $offset = -1;
        return $code;
    }

    /**
     * This function use to convert codes from Excel
     * @param $file
     */
    public function convertToCodes($file){
        ini_set('memory_limit', '2048M');
        ini_set('max_execution_time', '1200');

        $em = $this->container->get('doctrine')->getManager();
        $phpExcelObject = $this->container->get('phpexcel')->createPHPExcelObject($file);

        $row = 1;
        $found = false;
        $cols = ['A','B','C','D','E'];
        $data = [];
        do {

                $data[$row]['code'] = $phpExcelObject->getActiveSheet()->getCell('A'.$row)->getValue();
                $data[$row]['subCode'] = $phpExcelObject->getActiveSheet()->getCell('B'.$row)->getValue();
                $data[$row]['name'] = $phpExcelObject->getActiveSheet()->getCell('C'.$row)->getValue();
                $data[$row]['unit'] = $phpExcelObject->getActiveSheet()->getCell('D'.$row)->getValue();
                $data[$row]['price'] = $phpExcelObject->getActiveSheet()->getCell('E'.$row)->getValue();

                $found = (!empty($data[$row]['code'])) ? true : false;
                if($found === true){
                    $code = new CacheCodes();
                    $code->setName($data[$row]['name']);
                    $code->setCode($data[$row]['code']);
                    $code->setParentCode($data[$row]['subCode']);
                    $code->setUnit($data[$row]['unit']);
                    $code->setPrice($data[$row]['price']);

                    $em->persist($code);
                }

                if($row % 1000 === 0){
                    $em->flush();
                }

            $row ++;
        }while($found);


        $em->flush();
    }

    public function invoiceImport($file, $username){
        ini_set('memory_limit', '2048M');
        ini_set('max_execution_time', '1200');

        $em = $this->container->get('doctrine')->getManager();

        $curentUser = $em->getRepository('AppBundle:User')->findOneBy(['username'=>$username]);

        $phpExcelObject = $this->container->get('phpexcel')->createPHPExcelObject($file);

        $row = 1;
        $found = false;
        $cols = ['A','B','C','D','E'];
        $data = [];

        $now = new \DateTime('now');
        $invoice = new Invoice();
        $invoice->setAuthor($curentUser);
        $invoice->setNumber($curentUser->getUsername() . '-' . $now->getTimestamp());
        $em->persist($invoice);

        do {
            $data[$row]['name'] = $phpExcelObject->getActiveSheet()->getCell('A'.$row)->getValue();
            $data[$row]['count'] = $phpExcelObject->getActiveSheet()->getCell('B'.$row)->getFormattedValue();
            $data[$row]['unit'] = $phpExcelObject->getActiveSheet()->getCell('C'.$row)->getValue();
            $data[$row]['price'] = $phpExcelObject->getActiveSheet()->getCell('D'.$row)->getFormattedValue();
            $data[$row]['currency'] = $phpExcelObject->getActiveSheet()->getCell('E'.$row)->getValue();
            $data[$row]['neto'] = $phpExcelObject->getActiveSheet()->getCell('F'.$row)->getFormattedValue();
            $data[$row]['bruto'] = $phpExcelObject->getActiveSheet()->getCell('G'.$row)->getFormattedValue();
            $data[$row]['package'] = $phpExcelObject->getActiveSheet()->getCell('H'.$row)->getFormattedValue();
            $data[$row]['description'] = $phpExcelObject->getActiveSheet()->getCell('I'.$row)->getValue();
//dump($data[$row]); exit;
            $found = (!empty($data[$row]['name'])) ? true : false;
            if($found === true){
                $invoiceItem = new InvoiceItem();
                $invoiceItem->setName($data[$row]['name']);
                !empty($data[$row]['count']) ? $invoiceItem->setCount((float)$data[$row]['count']) : '';
                !empty($data[$row]['unit']) ? $invoiceItem->setUnit($data[$row]['unit']) : '';
                !empty($data[$row]['price']) ? $invoiceItem->setPrice((float)$data[$row]['price']) : '';
                !empty($data[$row]['count']) && !empty($data[$row]['price']) ? $invoiceItem->setSinglePrice((float)$data[$row]['price']/(float)$data[$row]['count']) : '';
                !empty($data[$row]['currency']) ? $invoiceItem->setCurency($data[$row]['currency']) : '';
                !empty($data[$row]['neto']) ? $invoiceItem->setNetto((float)$data[$row]['neto']) : '';
                !empty($data[$row]['bruto']) ? $invoiceItem->setBrutto((float)$data[$row]['bruto']) : '';
                !empty($data[$row]['package']) ? $invoiceItem->setPackage((float)$data[$row]['package']) : '';
                !empty($data[$row]['description']) ? $invoiceItem->setDescription($data[$row]['description']) : '';
                $invoiceItem->setInvoice($invoice);
                $em->persist($invoiceItem);
            }

            if($row % 1000 === 0){
                $em->flush();
            }

            $row ++;
        }while($found);


        $em->flush();
    }

    public function createReference($data, $state){

        ini_set('memory_limit', '2048M');
        ini_set('max_execution_time', '1200');

        $em = $this->container->get('doctrine')->getManager();
        $state ==1 ? $title ='Արձանագրություն' : $title='Ինքնարժեք';

        $brochuresDir = $this->container->getParameter('kernel.root_dir').'/../web/uploads/files/'.$data[0]->getReference()->getUser()->getUsername().'/';
        $fileName = $title.'_'.$data[0]->getReference()->getCode().'.xls';

        $file = $brochuresDir.$fileName;

        $fs = new Filesystem();
        $fs->touch($file);
        $fs->chown($file, 'www-data', true);


        $phpExcelObject = $this->container->get('phpexcel')->createPHPExcelObject();

        if($state ==1){
            $phpExcelObject->setActiveSheetIndex(0)
                ->setCellValue('B1', "«{$data[0]->getCompanyName()}» ՍՊԸ-ի")
                ->setCellValue('B2', 'կողմից  ՀՀ   ներմուծված ապրանքների  նախնական  զննությամբ ճշտված տվյալներով')
                ->setCellValue('C3', $title)
                ->setCellValue('A4', 'հ/հ')
                ->setCellValue('B4', 'Ապրանքի  անվանումը')
                ->setCellValue('C4', 'տեղերի քանակ')
                ->setCellValue('D4', 'քաշը բրուտտո')
                ->setCellValue('E4', 'քաշը նետտո')
                ->setCellValue('F4', 'քանակ հատ')
                ->setCellValue('G4', "գումար {$data[0]->getCurrencyName()}")
                ->setCellValue('H4', 'ծագման երկիր')
            ;
        }else{
            $phpExcelObject->setActiveSheetIndex(0)
                ->setCellValue('B1', "«{$data[0]->getCompanyName()}» ՍՊԸ-ի")
                ->setCellValue('B2', 'կողմից  ՀՀ   ներմուծված ապրանքների  նախնական  զննությամբ ճշտված տվյալներով')
                ->setCellValue('C3', $title)
                ->setCellValue('A4', 'հ/հ')
                ->setCellValue('B4', 'Ապրանքի  անվանումը')
                ->setCellValue('C4', 'Ըստ հատի')
                ->setCellValue('D4', 'Ըստ քաշի')
            ;
        }


        $i = 1;
        $j = 5;
        $brutto = 0;
        $netto = 0;
        $price = 0;
        $count = 0;
        $pakageQuantity = 0;
        foreach ($data as $item){
            if($state == 1){
                $phpExcelObject->setActiveSheetIndex(0)
                    ->setCellValue('A'.$j, "$i")
                    ->setCellValue('B'.$j, "{$item->getName()}")
                    ->setCellValue('C'.$j, "{$item->getPakageQuantity()}")
                    ->setCellValue('D'.$j, "{$item->getBrutto()}")
                    ->setCellValue('E'.$j, "{$item->getNetto()}")
                    ->setCellValue('F'.$j, "{$item->getCount()}")
                    ->setCellValue('G'.$j, "{$item->getPrice()}")
                    ->setCellValue('H'.$j, "{$item->getCountryName()}")
                ;
            }else{
                $phpExcelObject->setActiveSheetIndex(0)
                    ->setCellValue('A'.$j, "$i")
                    ->setCellValue('B'.$j, "{$item->getName()}")
                    ->setCellValue('C'.$j, "{$item->getCalcByCount()}")
                    ->setCellValue('D'.$j, "{$item->getCalcByWeight()}")

                ;
            }

                $i++;
            $j++;
            $brutto += $item->getBrutto();
            $netto +=$item->getNetto();
            $price +=$item->getPrice();
            $count +=$item->getCount();
            $pakageQuantity +=$item->getPakageQuantity();
        }
            $last = $j;
        if($state == 1) {
            $phpExcelObject->setActiveSheetIndex(0)
                ->setCellValue("A" . $last, "$i")
                ->setCellValue('B' . $last, " ")
                ->setCellValue('C' . $last, "{$pakageQuantity}")
                ->setCellValue('D' . $last, "{$brutto}")
                ->setCellValue('E' . $last, "{$netto}")
                ->setCellValue('F' . $last, "{$count}")
                ->setCellValue('G' . $last, "{$price}")
                ->setCellValue('H' . $last, " ");
        }

        $phpExcelObject->getProperties()->setCreator("liuggio")
            ->setLastModifiedBy("Giulio De Donato")
            ->setTitle("Office 2005 XLSX Test Document")
            ->setSubject("Office 2005 XLSX Test Document")
            //todo: company info
            ->setDescription("Արձանագրություն.")
            ->setKeywords("office 2005 openxml php")
            ->setCategory("Test result file");

        $phpExcelObject->getActiveSheet()->setTitle($title);
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $phpExcelObject->setActiveSheetIndex(0);

        // create the writer
        $writer = $this->container->get('phpexcel')->createWriter($phpExcelObject, 'Excel5');

        $writer->save($file);

        return $file;

    }


    /**
     * This function check import file type
     * @return array
     */
    public function xlsTypes()
    {
        $xlsTypes = array('application/CDFV2-corrupt',
            'applic ation/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'application/vnd.ms-office',
            'application/vnd.ms-excel');

        return $xlsTypes;
    }
}
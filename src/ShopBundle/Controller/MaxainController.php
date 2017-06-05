<?php

namespace ShopBundle\Controller;

use AppBundle\Form\InvoiceImportType;
use AppBundle\Form\UploadXmlType;
use APY\DataGridBundle\Grid\Action\RowAction;
use APY\DataGridBundle\Grid\Column\ActionsColumn;
use APY\DataGridBundle\Grid\Column\BlankColumn;
use APY\DataGridBundle\Grid\Column\DateColumn;
use APY\DataGridBundle\Grid\Source\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use ShopBundle\Entity\InvoiceItem;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\EncoderInterface;

/**
 * Class DefaultController
 * @package ShopBundle\Controller
 * @Route("/shop")
 */
class MaxainController extends Controller
{
    /**
     * @Route("/excel-convert", name="excel-convert")
     * @Security("has_role('ROLE_USER')")
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(new UploadXmlType());

        $em = $this->getDoctrine()->getManager();
        $message = array('success'=>'', 'errorMessage'=>'');
        // determination file types
        $xlsTypes = $this->container->get('app.convert.excel')->xlsTypes();
        // check form submit
        if($request->isMethod('POST')) {

            // get request & check
            $form->handleRequest($request);
            //check form validation
            if ($form->isValid()) {

                $fs = new Filesystem();
                // form get date
                $data = $form->getData();
                $file = $data['file'];
                $name = 'data';
                // corrections of uploaded file name because is sended from cli
                $fileName = $name . (str_replace(' ', '_', str_replace('(', '_', str_replace(')', '_', $file->getClientOriginalName()))));
                // save file in /web/uploads/files folder
                $brochuresDir = $this->container->getParameter('kernel.root_dir') . '/../web/uploads/files';
                $mainDir = str_replace('/app', '/', $this->container->getParameter('kernel.root_dir'));
                //get corrent user
                $username = $this->getUser()->getUsername();

                if(is_file($file) && in_array($file->getMimeType(), $xlsTypes)){

                    if($fs->exists($brochuresDir.'/'.$fileName)){
                        unlink($brochuresDir.'/'.$fileName);
                    }

                    $file->move($brochuresDir, $fileName);

                    $file = $brochuresDir.'/'.$fileName;
                    $this->container->get('app.convert.excel')->convertToCodes($file);

                    if($fs->exists($brochuresDir.'/'.$fileName)){
                        unlink($brochuresDir.'/'.$fileName);
                    }

                    $this->addFlash(
                        'notice',
                        'Uploaded!'
                    );
                }

            }
        }

        return $this->render('ShopBundle:Maxain:index.html.twig',
            array('form' => $form->createView()));
    }

    /**
     * @Route("/invoice-import", name="invoice-import")
     * @Security("has_role('ROLE_USER')")
     */
    public function invoiceImportAction(Request $request)
    {

        $source = new Entity('ShopBundle:Invoice');

        /* @var $grid \APY\DataGridBundle\Grid\Grid */
        $grid = $this->get('grid');
        $grid->setSource($source);

//        $MyTypedColumn = new DateColumn(array('id' => 'buy_count', 'title' => 'Need Count', 'source' => true, 'filterable' => true, 'sortable' => true));
//        $grid->addColumn($MyTypedColumn);

        // Create an Actions Column
        $actionsColumn = new ActionsColumn('action_column', 'Action Column');
        $grid->addColumn($actionsColumn, 4);

        // Attach a rowAction to the Actions Column
        $rowAction1 = new RowAction('Show', 'show_single_id', false, '_self', array('class'=>'show_custom'));
        $rowAction1->setColumn('action_column');
        $grid->addRowAction($rowAction1);
        $grid->setDefaultOrder('id', 'ASC');


        $form = $this->createForm(new InvoiceImportType());

        $em = $this->getDoctrine()->getManager();
        $message = array('success'=>'', 'errorMessage'=>'');
        // determination file types
        $xlsTypes = $this->container->get('app.convert.excel')->xlsTypes();
        // check form submit
        if($request->isMethod('POST')) {

            // get request & check
            $form->handleRequest($request);
            //check form validation
            if ($form->isValid()) {

                $fs = new Filesystem();
                // form get date
                $data = $form->getData();
                $file = $data['file'];
                $name = 'data';
                // corrections of uploaded file name because is sended from cli
                $fileName = $name . (str_replace(' ', '_', str_replace('(', '_', str_replace(')', '_', $file->getClientOriginalName()))));
                // save file in /web/uploads/files folder
                $brochuresDir = $this->container->getParameter('kernel.root_dir') . '/../web/uploads/files';
                $mainDir = str_replace('/app', '/', $this->container->getParameter('kernel.root_dir'));
                //get corrent user
                $username = $this->getUser()->getUsername();

                if(is_file($file) && in_array($file->getMimeType(), $xlsTypes)){

                    $fileDir = $brochuresDir.'/'.str_replace(' ', '_', strtolower($username));
                    $fs->mkdir($fileDir);
                    $fs->chown($fileDir, 'www-data', true);

                    if($fs->exists($fileDir.'/'.$fileName)){
                        unlink($fileDir.'/'.$fileName);
                    }

                    $file->move($fileDir, $fileName);

                    $file = $fileDir.'/'.$fileName;
                    $this->container->get('app.convert.excel')->invoiceImport($file, $username);

                    if($fs->exists($fileDir.'/'.$fileName)){
                        unlink($fileDir.'/'.$fileName);
                    }

                    $this->addFlash(
                        'notice',
                        'Uploaded!'
                    );
                }

            }
        }



        return $grid->getGridResponse('ShopBundle:Maxain:index.html.twig',
            array('form' => $form->createView()));
    }

    /**
     * @Route("/show_single/{id}", name="show_single_id")
     * @Security("has_role('ROLE_USER')")
     */
    public function showSingleAction(Request $request, $id)
    {

        $source = new Entity('ShopBundle:InvoiceItem');

        $tableAlias = $source->getTableAlias();

        $user = $this->getUser();
        $state = InvoiceItem::IS_ACTIVE;
        $source->manipulateQuery(function ($query) use ($tableAlias, $state, $id) {
            $query->where($tableAlias . '.invoice = '.$id);
            $query->andWhere($tableAlias . '.state = '.$state);
        });


        /* @var $grid \APY\DataGridBundle\Grid\Grid */
        $grid = $this->get('grid');

        $params = array('id' => 'grouped', 'title' => 'Items group', 'size' => '200');
        $MyColumn = new BlankColumn($params);

        // Add the column to the last position
        $grid->addColumn($MyColumn, 1);
        $grid->setSource($source);

//        $MyTypedColumn = new DateColumn(array('id' => 'buy_count', 'title' => 'Need Count', 'source' => true, 'filterable' => true, 'sortable' => true));
//        $grid->addColumn($MyTypedColumn);

        // Create an Actions Column
        $actionsColumn = new ActionsColumn('action_column', 'Action Column');
        $grid->addColumn($actionsColumn, 16);

        // Attach a rowAction to the Actions Column
        /*$rowAction1 = new RowAction('Show', 'show_single_id', false, '_self', array('class'=>'show_custom'));
        $rowAction1->setColumn('action_column');*/
//        $rowAction2 = new RowAction('Delete', 'merge_items', false, '_self', array('class'=>'show_custom'));
//        $rowAction2->setColumn('action_column');
        // create a column
// OR add this column to the third position


// OR add this column to the next to last position
        
//        $grid->addRowAction($rowAction1);
//        $grid->addRowAction($rowAction2);
        $grid->setDefaultOrder('id', 'ASC');

        return $grid->getGridResponse('ShopBundle:Maxain:show_single.html.twig');
    }

    /**
     * @Route("/merge", name="merge_items")
     * @Security("has_role('ROLE_USER')")
     */
    public function meargeAction(){

        return true;
    }
}

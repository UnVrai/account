<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

require_once storage_path('app/library/odf.php');


class OrderPrintController extends Controller
{
    public function common() {
        $odf = new \odf(storage_path('app/order_common.odt'));

        $odf->setVars('Name', '公分石');
        $odf->setVars('Number', '3.5方');
        $odf->setVars('Price', '60');
        $odf->setVars('Total', '210');
        $odf->saveToDisk(storage_path('app/order_cache.odt'));


//        $common_path = 'order/common/';
//
//        $temp = new TemplateProcessor(storage_path('app/order.doc'));
//        $temp->setValue('Name', '公分石');
//        $temp->setValue('Number', '3.5方');
//        $temp->setValue('Price', '60');
//        $temp->setValue('Total', '210');
////        $temp->setValue('Actual', '200');
////
////        $temp->setValue('f', '零');
////        $temp->setValue('j', '零');
////        $temp->setValue('g', '零');
////        $temp->setValue('s', '零');
////        $temp->setValue('b', '贰');
////        $temp->setValue('q', '零');
////        $temp->setValue('w', '零');
////
////        $temp->setValue('Year', date('Y'));
////        $temp->setValue('Month', date('m'));
////        $temp->setValue('Day', date('d'));
//
//        $temp->saveAs(storage_path('app/order_cache.doc'));
        word2pdf(storage_path('app/order_cache.odt'), public_path('order/common/order.pdf'));
        return view('testprint');
    }

}

function MakePropertyValue($name,$value,$osm){
    $oStruct = $osm->Bridge_GetStruct("com.sun.star.beans.PropertyValue");
    $oStruct->Name = $name;
    $oStruct->Value = $value;
    return $oStruct;
}

function word2pdf($doc_file, $output_file){
    $doc_url = 'file:///'.str_replace('\\', '/', $doc_file);
    $output_url = 'file:///'.str_replace('\\', '/', $output_file);
    //Invoke the OpenOffice.org service manager
    $osm = new \COM("com.sun.star.ServiceManager") or die ("Please be sure that OpenOffice.org is installed.\n");
    //Set the application to remain hidden to avoid flashing the document onscreen
    $args = array(MakePropertyValue("Hidden",true,$osm));
    //Launch the desktop
    $oDesktop = $osm->createInstance("com.sun.star.frame.Desktop");
    //Load the .doc file, and pass in the "Hidden" property from above
    $oWriterDoc = $oDesktop->loadComponentFromURL($doc_url,"_blank", 0, $args);
    //Set up the arguments for the PDF output
    $export_args = array(MakePropertyValue("FilterName","writer_pdf_Export",$osm));
    //print_r($export_args);
    //Write out the PDF
    $oWriterDoc->storeToURL($output_url,$export_args);
    $oWriterDoc->close(true);
}
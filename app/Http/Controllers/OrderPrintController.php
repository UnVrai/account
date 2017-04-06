<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

require_once storage_path('app/library/odf.php');


class OrderPrintController extends Controller
{
    public function common(Request $request) {
        $odf = new \odf(storage_path('app/order_common.odt'));
        $input = $request->all();
        $dx = [ '0' => '零',
                '1' => '壹',
                '2' => '贰',
                '3' => '叁',
                '4' => '肆',
                '5' => '伍',
                '6' => '陆',
                '7' => '柒',
                '8' => '捌',
                '9' => '玖'];

        $serial = $input['serial'];
        $odf->setVars('Serial', sprintf('%07s', $serial));
        $odf->setVars('Name', $input['name']);
        $odf->setVars('Number', $input['number'].'方');
        $odf->setVars('Price', $input['price']);
        $odf->setVars('Total', $input['total']);
        $actual = $input['actual'];
        $odf->setVars('Actual', $actual);

        $actual = sprintf('%05s', $actual);
        $odf->setVars('f', '零');
        $odf->setVars('j', '零');
        $odf->setVars('g', $dx[$actual[4]]);
        $odf->setVars('s', $dx[$actual[3]]);
        $odf->setVars('b', $dx[$actual[2]]);
        $odf->setVars('q', $dx[$actual[1]]);
        $odf->setVars('w', $dx[$actual[0]]);

        $odf->setVars('y', date('Y'));
        $odf->setVars('m', date('m'));
        $odf->setVars('d', date('d'));
        
        $odf->saveToDisk(storage_path('app/order_cache.odt'));

        word2pdf(storage_path('app/order_cache.odt'), public_path('order/common/order.pdf'));
        return 'success';
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
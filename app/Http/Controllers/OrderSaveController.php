<?php

namespace App\Http\Controllers;

use App\Debtor;
use App\Order;
use Illuminate\Http\Request;
use Storage;
use DB;

require_once resource_path('assets/library/odf.php');


class OrderSaveController extends Controller
{
    public $dx = [ '0' => '零',
        '1' => '壹',
        '2' => '贰',
        '3' => '叁',
        '4' => '肆',
        '5' => '伍',
        '6' => '陆',
        '7' => '柒',
        '8' => '捌',
        '9' => '玖'];


    public function common(Request $request) {
        $input = $request->all();
        $order = new Order;
        $order->id = $input['serial'];
        $order->name = $input['name'];
        $order->number = $input['number'];
        $order->price = $input['price'];
        $order->total = $input['total'];
        $order->actual = $input['actual'];
        $order->save();

        $path = $this->commonToPdf($request->all());
//        $path = '';
        DB::table('common')->where('name', 'commonSerial')->update(['value' => $input['serial'] + 1]);
        return $path;
    }

    public function commonPrint() {

    }

    public function debt(Request $request) {
        $input = $request->all();

        $id = $input['id'];
        $debtor = Debtor::find($id);
        $debtor->number = $input['number'];
        $debtor->save();

//        $path = $this->deptToPdf($input);
        $path = '';
        DB::table('common')->where('name', 'debtSerial')->update(['number' => $input['serial'] + 1]);
        return $path;
    }

    function commonToPdf($input) {
        $odf = new \odf(resource_path('assets/order_common.odt'));

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
        $odf->setVars('g', $this->dx[$actual[4]]);
        $odf->setVars('s', $this->dx[$actual[3]]);
        $odf->setVars('b', $this->dx[$actual[2]]);
        $odf->setVars('q', $this->dx[$actual[1]]);
        $odf->setVars('w', $this->dx[$actual[0]]);

        $odf->setVars('y', date('Y'));
        $odf->setVars('m', date('m'));
        $odf->setVars('d', date('d'));

        $odf->saveToDisk(storage_path('app/order_cache.odt'));

        $path = 'order.pdf';
        word2pdf(storage_path('app/order_cache.odt'), public_path($path));
        return '/'.$path;
    }


    function deptToPdf($input) {

        $odf = new \odf(storage_path('app/order_debt.odt'));
        $serial = $input['serial'];
        $odf->setVars('Serial', sprintf('%07s', $serial));
        $person = $input['person'];
        $odf->setVars('Person', $person);
        $odf->setVars('Name', $input['name']);
        $odf->setVars('Number', $input['number'].'方');
        $odf->setVars('Price', $input['price']);
        $total = $input['total'];
        $odf->setVars('Total', $total);
        $odf->setVars('Debtor', $input['debtor']);
        $odf->setVars('Guarantor', $input['guarantor']);

        $total = explode('.', $total);
        $int = sprintf('%05s', $total[0]);
        $decimal = sizeof($total) == 2 ? $total[1] : '';
        $decimal = str_pad($decimal, 2, '0');
        $odf->setVars('f', $this->dx[$decimal[1]]);
        $odf->setVars('j', $this->dx[$decimal[0]]);
        $odf->setVars('g', $this->dx[$int[4]]);
        $odf->setVars('s', $this->dx[$int[3]]);
        $odf->setVars('b', $this->dx[$int[2]]);
        $odf->setVars('q', $this->dx[$int[1]]);
        $odf->setVars('w', $this->dx[$int[0]]);

        $odf->setVars('y', date('Y'));
        $odf->setVars('m', date('m'));
        $odf->setVars('d', date('d'));

        $odf->saveToDisk(storage_path('app/order_cache.odt'));

        $path = 'storage/debt/'.$person.$serial.'.pdf';
        word2pdf(storage_path('app/order_cache.odt'), iconv('UTF-8','GBK',public_path($path)));
        return '/'.$path;
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
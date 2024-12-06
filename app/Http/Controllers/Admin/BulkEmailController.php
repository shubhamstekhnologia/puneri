<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BulkEmail;
use DB;
use File;
use Session;
use App\Traits\Features;
use App\VendorBusinessDetails;
use Illuminate\Support\Facades\Schema;
use App\Exports\ProductsExport;
use Excel;
use DateTime;
use DateTimeZone;

class BulkEmailController extends Controller
{

    use Features;
   
   
  public function exportEmail() {
        //return Excel::download(new ProductsExport, 'products.csv');
        $headings = [
            'id',
            'email',
            'created_at',
            'updated_at',
        ];
        $date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
		$date = $date->format('Y-m-d');
        return (new ProductsExport($date,$headings))->download($date.'_products.csv');
    }
    
    public function importEmail(Request $request) {
        $request->validate([
            'import_file' => 'required'
        ]);
 
        $path = $request->file('import_file')->getRealPath();
        if (($handle = fopen ( $path, 'r' )) !== FALSE) {
            
            while ( ($data = fgetcsv ( $handle, 1000, ',' )) !== FALSE ) {
                $csv_data = new BulkEmail();
                //$csv_data->id = $data [0];
                $csv_data->email = $data [1];
                $csv_data->save ();
            }
            fclose ( $handle );
        }

       return redirect('upload_import_csv')->with('success', 'Insert Record successfully.');
    }
    
    public function uploadEmailCSV() {
        return view('templates.SuperAdmin.upload_pro_csv');
    }
}
<?php

namespace App\Http\Controllers;

use App\Exports\ProductExport;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\LaravelIgnition\Recorders\DumpRecorder\Dump;
use \PDF;

class ExportController extends Controller
{


    public function store(Request $request)
    {
        // dd($request->all());
        $data = new Product;

        if($request->select != null){
            foreach($request->select as $key => $value){
                if($value == 'id'){
                    $valuesss = $value;
                }
                if($value == 'name'){
                    $valuesss = $value;
                }
                if($value == 'qty'){
                    $valuesss = $value;
                }
                if($value == 'price'){
                    $valuesss = $value;
                }
                if($value == 'sku'){
                    $valuesss = $value;
                }
                if($value == 'desc'){
                    $valuesss = $value;
                }
                if($value == 'updated_at'){
                    $valuesss = $value;
                }
                $array[] = $valuesss;
    
            }
        }else{
            return redirect()->back()->with('ERROR','Select The Field');
        }
        // dd($array);
        $data = $data->select($array);
        $data = $data->get();
        $key = $request->select;
        // if(in_array('updated_at',$key)){
        //     foreach($data as $keys => $value){
        //         $date=date_format($value->updated_at,"d/m/Y");
        //         dump($date);
        //     }
        // }
        // dd($value->updated_at);
        
        return Excel::download(new ProductExport($data,$key), 'productlist.xlsx');
    }

    public function dowpdf()
    {
        $product = Product::all();
        $pdf = PDF::loadView('pdffile',compact('product'));
        return $pdf->download('product.pdf');
    }
}

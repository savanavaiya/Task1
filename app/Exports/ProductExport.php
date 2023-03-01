<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Spatie\LaravelIgnition\Recorders\DumpRecorder\Dump;

class ProductExport implements FromCollection,WithHeadings,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($data,$key)
    {
        $this->key = $key;
        $this->data = $data;
        
    }
    

    public function headings():array{
        // return $this->collection()->first()->keys()->toArray();
        // return $this->data->keys()->toArray();
        return $this->key;
    } 
    
    public function collection()
    {   
        
        return $this->data;


    }
    
}

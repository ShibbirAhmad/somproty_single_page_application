<?php

namespace App\Exports;

use App\Models\Supplier;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class SupplierExport implements FromCollection , WithHeadings , ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $collections = Supplier::all();

        foreach($collections as  $item){
            unset($item->id,$item->status,$item->created_at,$item->updated_at );
             $collections[]=$item;
         }

        return $collections;

    }
     
    public function headings():  array
    {
        return self::columnWidths( 'Name','Company Name','Phone','Address');
    }
 

    public static function  columnWidths($name,$company, $phone, $address): array {

         return [

                 $name,  $company, $phone, $address
         ];
    }



}

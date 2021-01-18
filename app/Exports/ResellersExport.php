<?php

namespace App\Exports;

use App\Models\Reseller;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\DB;

class ResellersExport implements FromCollection , WithHeadings , ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $collections = Reseller::all();

        foreach($collections as  $item){
            unset($item->id,$item->password,$item->image,$item->updated_at,$item->created_at,$item->status);
             $item->phone="0".$item->phone;
             $item->bkash_number="0".$item->bkash_number;
             $collections[]=$item;
         }

        return $collections;

    }
     
    public function headings():  array
    {
        return self::columnWidths( 'Name','Company Name','username','Email','Phone','Bkash Number','Address');
    }
 

    public static function  columnWidths($name,$company_name,$usename,$email,$phone,$bkash,$address): array {

         return [

                 $name,$company_name,$usename,$email,$phone,$bkash,$address
         ];
    }


}

<?php

namespace App\Exports;

use App\Models\Merchant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class MerchantExport implements FromCollection , WithHeadings , ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $collections = Merchant::all();

        foreach($collections as  $item){
            unset($item->id,$item->password,$item->image,$item->status,$item->remember_token,$item->created_at,$item->updated_at );
             $collections[]=$item;
         }

        return $collections;

    }
     
    public function headings():  array
    {
        return self::columnWidths( 'Name','Email','Phone','Company Name','Address');
    }
 

    public static function  columnWidths($name,$email,$phone,$company, $address): array {

         return [

                 $name, $email, $phone, $company ,$address
         ];
    }



}

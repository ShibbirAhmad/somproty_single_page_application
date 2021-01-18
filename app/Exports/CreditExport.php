<?php

namespace App\Exports;

use App\Models\Credit;
use App\Models\Admin ;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class CreditExport implements FromCollection , WithHeadings , ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $collections = Credit::all();

        foreach($collections as  $item){

            unset($item->id,$item->created_at,$item->updated_at );
            $admin=Admin::find($item->insert_admin_id);
             $item->insert_admin_id=$admin->name;
             $collections[]=$item ;
         }

        return $collections;

    }
     
    public function headings():  array
    {
        return self::columnWidths( 'Date','Purpose','creditIn','Amount','Details Comment','creditBy');
    }
 

    public static function  columnWidths($date,$purpose,$creditin,$amount, $comment, $creditby) : array {

         return [

                 $date, $purpose, $creditin, $amount, $comment, $creditby 
         ];
    }



}

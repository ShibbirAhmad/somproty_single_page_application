<?php

namespace App\Exports;

use App\Models\Debit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Models\Admin  ;

class DebitExport implements FromCollection , WithHeadings , ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $collections = Debit::all();

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
        return self::columnWidths( 'Date','Purpose','Debit From','Amount','Details Comment','Debit By');
    }
 

    public static function  columnWidths($date,$purpose,$debit_from,$amount, $comment, $debitby) : array {

         return [

                 $date, $purpose, $debit_from, $amount, $comment, $debitby 
         ];
    }



}

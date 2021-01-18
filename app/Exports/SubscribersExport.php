<?php

namespace App\Exports;

use App\Models\Subscriber;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SubscribersExport implements FromCollection  , WithHeadings , ShouldAutoSize 
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $collections = Subscriber::all();

        foreach($collections as  $item){
            unset($item->id, $item->created_at, $item->updated_at );
                 $collections[]=$item;
         }

        return $collections;

    }
     
    public function headings():  array
    {
        return self::columnWidths( 'Email');
    }
 

    public static function  columnWidths($email): array {

         return [

                 $email
         ];
    }



}

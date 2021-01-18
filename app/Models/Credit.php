<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    public function admin(){
        return $this->belongsTo('App\Models\Admin','insert_admin_id');
    }

    public static function Balance(){

        $balnce=array();
        //calculation credit balance, al and today

         //get the all credit item,item store a variable then it's use 
        $all_credit_item=Credit::all();
        $balnce['total_credit']=$all_credit_item->sum('amount');
        $balnce['total_credit_cash']=$all_credit_item->where('credit_in','Cash')->sum('amount');
        $balnce['total_credit_bkash_personal']=$all_credit_item->where('credit_in','Bkash(personal)')->sum('amount');
        $balnce['total_credit_bkash_merchant']=$all_credit_item->where('credit_in','Bkash(merchant)')->sum('amount');
        $balnce['total_credit_bank_sibl']=$all_credit_item->where('credit_in','Bank(SIBL)')->sum('amount');
        $balnce['total_credit_bank_aibl']=$all_credit_item->where('credit_in','Bank(AIBL)')->sum('amount');

          
        //get the today credit item,item store a variable then it's use 
        $today_credit_item=Credit::where('date', '>=', Carbon::today()->startOfDay())
                                        ->where('date', '<=', Carbon::today()->endOfDay())
                                        ->get();   
        $balnce['today_credit']=$today_credit_item->sum('amount');
        $balnce['today_credit_cash']=$today_credit_item->where('credit_in','Cash')->sum('amount');
        $balnce['today_credit_bkash_personal']=$today_credit_item->where('credit_in','Bkash(personal)')->sum('amount');
        $balnce['today_credit_bkash_merchant']=$today_credit_item->where('credit_in','Bkash(merchant)')->sum('amount');
        $balnce['today_credit_bank_sibl']=$today_credit_item->where('credit_in','Bank(SIBL)')->sum('amount');
        $balnce['today_credit_bank_aibl']=$today_credit_item->where('credit_in','Bank(AIBL)')->sum('amount');


        //calculate the debit balcne

        $total_debit_item=Debit::all(); 
        $balnce['total_debit']=$total_debit_item->sum('amount');
        $balnce['total_debitt_cash']=$total_debit_item->where('debit_from','Cash')->sum('amount');
        $balnce['total_debit_bkash_personal']=$total_debit_item->where('debit_from','Bkash(personal)')->sum('amount');
        $balnce['total_debit_bkash_merchant']=$total_debit_item->where('debit_from','Bkash(merchant)')->sum('amount');
        $balnce['total_debit_bank_sibl']=$total_debit_item->where('debit_from','Bank(SIBL)')->sum('amount');
         $balnce['total_debit_bank_aibl']=$total_debit_item->where('debit_from','Bank(AIBL)')->sum('amount');


        //get the today debit item,item store a variable then it's use 
        $today_debit_item=Debit::where('date', '>=', Carbon::today()->startOfDay())
                                        ->where('date', '<=', Carbon::today()->endOfDay())
                                        ->get(); 

        $balnce['today_debit']=$today_debit_item->sum('amount');
        $balnce['today_debitt_cash']=$today_debit_item->where('debit_from','Cash')->sum('amount');
        $balnce['today_debit_bkash_personal']=$today_debit_item->where('debit_from','Bkash(personal)')->sum('amount');
        $balnce['today_debit_bkash_merchant']=$today_debit_item->where('debit_from','Bkash(merchant)')->sum('amount');
        $balnce['today_debit_bank_sibl']=$today_debit_item->where('debit_from','Bank(SIBL)')->sum('amount');
         $balnce['today_debit_bank_aibl']=$today_debit_item->where('debit_from','Bank(AIBL)')->sum('amount');


        return $balnce;                                  
    }
}

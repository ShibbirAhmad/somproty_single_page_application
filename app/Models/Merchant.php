<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Merchant extends Authenticatable
{
    use Notifiable;
    protected $guard = 'merchant';

     public static function SendMerchantPasswordResetCode($contacts,$code)
    {
    

        $api_key = "C20047545e16e1c02a1b38.69878796";
        $senderid = '8809601000740';
       
        $sms = "Your password reset code is ".$code.' Thanks by mohasagor.com';   // put here your dynamic message text here
        $URL = "http://bulk.fmsms.biz/smsapi?api_key=" . urlencode($api_key) . "&type=text&contacts=" . urlencode($contacts) . "&senderid=" . urlencode($senderid) . "&msg=" . urlencode($sms);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $URL);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 0);
        try {
            $output = $content = curl_exec($ch);
            //  print_r($output);
        } catch (Exception $ex) {
            $output = "-100";
        }
        return $output;

        
    }
}

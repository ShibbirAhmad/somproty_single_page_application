<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer ;
use Maatwebsite\Excel\Facades\Excel ;
use App\Exports\CustomersExport ;
use App\Exports\RetailCustomersExport ;
use App\Exports\WholesaleCustomersExport ;
use App\Exports\OfficesaleCustomersExport ;

class CustomerController extends Controller
{
    public function getCustomer(){
        
        $customers= Customer::orderBy('id','DESC')->with('customerCity')->paginate(20);
        return response()->json([
           'customers' => $customers,
           'status' => 'SUCCESS'
       ]);
 }



 public function searchCustomer($data){
       
    $customers= Customer::where('name','like','%'.$data.'%')->orWhere('phone','like','%'.$data.'%')->with('customerCity')->paginate(20);
            return response()->json([
                'success' => 'OK',
            'customers' => $customers,
            
        ]);
}


 public  function export_customers(){
        
        return Excel::download(new CustomersExport(), 'customers.xlsx') ;
 }



 public  function export_retail_customers(){
        
      return Excel::download(new RetailCustomersExport(),'retail_customer.xlsx');
 }


 public  function export_wholesale_customers(){
        
      return Excel::download(new WholesaleCustomersExport(),'wholesale_customer.xlsx');
 }

 public  function export_officesale_customers(){
        
      return Excel::download(new OfficesaleCustomersExport(),'officesale_customer.xlsx');
 }




}

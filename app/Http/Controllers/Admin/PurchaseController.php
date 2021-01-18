<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Purchaseitem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Debit;
use App\Models\Supplier;
use App\Models\SupplierPayment;
use Intervention\Image\Facades\Image;
class PurchaseController extends Controller
{

    public function index(Request $request)
    {
        $paginate = $request->item ?? 10;
        $status=$request->status ?? 1;
        $purchases = Purchase::orderBy('id', 'DESC')->with('supplier')->where('status',$status)->paginate($paginate);
        if ($purchases) {
            return response()->json([
                'status' => 'SUCCESS',
                'purchases' => $purchases
            ]);
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

     // return $request->all();

    //   if($request->hasFile('memo')){
    //     return "yes";
    //   }else{
    //       return "no";
    //   }

        $this->validate($request, [
            'supplier_id' => 'required|',
            'invoice_no' => 'required|',
          'memo' => 'required',
          //  'AmountTotal' => 'required|numeric',

        ]);

        //first save the purchase information
        $purchase = new Purchase();
        $purchase->supplier_id = $request->supplier_id;
        $purchase->invoice_no = $request->invoice_no;
        $purchase->total = $request->total;
        $purchase->paid = $request->paid ?? 0;
        $purchase->status=$request->status;
        $purchase->purchase_date = $request->purchase_date;

        if($request->hasFile('memo')){
            $path=$request->file('memo')->store('file/memo', 'public');
            $purchase->file=$path;
        }

        $purchase_memo='memo-'.time().'.jpg';

     //   return $purchase_memo;
        Image::make(file_get_contents($request->memo))->save(public_path('storage/images/purchase_memo/').$purchase_memo);
        $purchase->file='images/purchase_memo/'.$purchase_memo;
        $purchase->save();

        if(!empty($request->products)){
        
        //save the purchase item
        foreach ($request->products as $item) {

            $product = Product::where('id', $item['product_id'])->first();
            $product->stock = $product->stock + $item['quantity'];
            $product->save();
            $p_item = new Purchaseitem();
            $p_item->purchase_id = $purchase->id;
            $p_item->product_id = $item['product_id'];
            $p_item->price = $item['price'];
            $p_item->insert_quantity = $item['quantity'];
            $p_item->stock = $item['quantity'];
            $p_item->save();


        }
        }

       //save a supplier paid amount 
       if($purchase->paid>0){
         $supplier_payment=new SupplierPayment();
         $supplier_payment->supplier_id=$request->supplier_id;
         $supplier_payment->amount=$request->paid;
         $supplier_payment->date=$request->purchase_date;
         $supplier_payment->paid_by=$request->paid_by;
         $supplier_payment->save();
       }


       //create a debit

       if($request->paid>0){
           $comment="Product Purchase";
           if(empty($request->products)){
            $comment="Fabrics Purchase";
           }
           $debit = new Debit();
            $debit->purpose =9;
            $debit->debit_from=$request->paid_by;
            $debit->amount = $request->paid;
            $debit->comment = "'$comment'.Paid Amount '$request->paid'";
            $debit->date = $request->purchase_date;
            $debit->insert_admin_id=session()->get('admin')['id'];
            $debit->save();
       }

      return response()->json([
            'status' => 'SUCCESS',
            'message' => 'new purchase was added'
        ]);

    }

    
    public function show($id)
    {
        
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

    public function details($id){
        $purchase=Purchase::find($id);
        $details=Purchaseitem::where('purchase_id',$id)->with(['product'])->get();
         return response()->json([
            'status'=>'SUCCESS',
            'purchase'=>$purchase,
            'details'=>$details,
            'merchant'=>Supplier::where('id',$purchase->supplier_id)->first(),
        ]);
 }


 
    
 public function  search_according_data($search){

    $purchases = Purchase::where('invoice_no','like', '%' . $search . '%') 
                    ->orderBy('id', 'DESC')->with('supplier')
                    ->paginate(10);
                   
    return response()->json([
        'status'=>'OK',
        'purchases'=>$purchases
     ]);        
}




public function  according_date_wise(Request $request){
    
    $purchases='';
    $paginate=$request->item??10;
    if(!empty($request->start_date) && empty($request->end_date)){
        
            $purchases=Purchase::whereDate('created_at','=',$request->start_date)->with('supplier')
                         ->paginate($paginate);
         
    }
    elseif(!empty($request->end_date) && !empty($request->start_date)){

            $purchases=Purchase::whereDate('created_at', '>=', $request->start_date)
                            ->whereDate('created_at', '<=', $request->end_date)->with('supplier')
                            ->paginate($paginate);
     }else{

        $purchases=Purchase::whereDate('created_at','=',$request->end_date)->with('supplier')
                 ->paginate($paginate);
          
     }
         return response()->json([
                    'status'=>'OK',
                    'purchases'=>$purchases
  
  ]);


}

public function uploadFile(Request $request){
   
    $purchase=Purchase::where('id',$request->id)->first();
    if($request->hasFile('file')){
        $path=$request->file('file')->store('file/memo','public');
        $purchase->file=$path;
        $purchase->save();
        return response()->json('ok');
    }


}

}

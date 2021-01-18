<?php

namespace App\Http\Controllers\Admin;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\SupplierPayment;
use App\Exports\SupplierExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;


class SupplierController extends Controller
{

    public function __construct()
    {
        return $this->middleware('admin');
        
    }

    public function index(Request $request)
    {
        $suppliers = Supplier::orderBy('id', 'DESC')->where('type',$request->type)->paginate(20);
        return response()->json([
            'status' => 'SUCCESS',
            'suppliers' => $suppliers
        ]);
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

       // return  $request->all();
        $validatedData = $request->validate([
            //'name' => 'required ',
            'company_name' => 'required',
            'address' => 'required',
            'phone' => 'required|unique:suppliers|digits:11',


        ]);
        $supplier = new Supplier();
        $supplier->name = $request->name ?? $request->company_name;
        $supplier->company_name = $request->company_name;
        $supplier->address = $request->address;
        $supplier->phone = $request->phone;
        $supplier->type=$request->type ?? 1;

        if ($supplier->save()) {
            if(!empty($request->opening_balance)){
              //  $invoice_no=Purchase::max('invoice_no') ?? 0;
                $purchase=new Purchase();
                $purchase->total=$request->opening_balance;
                $purchase->supplier_id=$supplier->id;
                $purchase->invoice_no=0000;
                $purchase->paid=0;
                $purchase->status=$supplier->type;
                $purchase->purchase_date= date('Y-m-d');
                $purchase->save();
            }
            return response()->json([
                'status' => 'SUCCESS',
                'message' => 'supplier add successfully'
            ]);
        }
    }

    public function show($id)
    {
        //
    }

    public function search_supplier($data){

        $suppliers = Supplier::where('company_name','like','%'.$data.'%')
                        ->orWhere('name','like','%'.$data.'%')
                        ->orWhere('phone','like','%'.$data.'%')
                        ->orWhere('address','like','%'.$data.'%')
                        ->paginate(10);

            return response()->json([
            "status" => "OK",
            'suppliers' => $suppliers ,
            ]);   
    }



    public function edit($id)
    {
        $supplier = Supplier::find($id);
        if ($supplier) {
            return response()->json([
                'status' => 'SUCCESS',
                'supplier' => $supplier
            ]);
        }
    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required ',
            'company_name' => 'required',
            'address' => 'required',
            'phone' => 'required',


        ]);
        $supplier = Supplier::find($id);

        if ($supplier) {
            $supplier->name = $request->name;
            $supplier->company_name = $request->company_name;
            $supplier->address = $request->address;
            $supplier->phone = $request->phone;
            if ($supplier->save()) {
                return response()->json([
                    'status' => 'SUCCESS',
                    'message' => 'supplier update successfully'
                ]);
            }
        }

    }


    public function destroy($id)
    {
        //
    }

    public function active($id)
    {
        $supplier = Supplier::find($id);
        if ($supplier) {
            $supplier->status = 1;
            if ($supplier->save()) {
                return response()->json([
                    'status' => 'SUCCESS',
                    'message' => 'supplier active successfully'
                ]);
            }
        }
    }

    public function deActive($id)
    {
        $supplier = Supplier::find($id);
        if ($supplier) {
            $supplier->status = 0;
            if ($supplier->save()) {
                return response()->json([
                    'status' => 'SUCCESS',
                    'message' => 'supplier de-active successfully'
                ]);
            }
        }
    }

    public function supplierAmountList($id){

         $total_paid_item=SupplierPayment::where('supplier_id',$id)->orderBy('date','DESC')->get();
         $purchase_items=Purchase::where('supplier_id',$id)->with('purchaseItems')->get();
         $supplier_amount=array();
         $supplier_amount['total_purchase_amount']=Purchase::where('supplier_id',$id)->sum('total');
         $supplier_amount['total_paid_amount']=$total_paid_item->sum('amount');
         $supplier=Supplier::where('id',$id)->first();
         
         return response()->json([
             'amount'=>$supplier_amount,
             'paid_items'=>$total_paid_item,
             'supplier'=>$supplier,
             'purchase_items'=>$purchase_items
         ]);
    }

    public function supplierList(){
        $suppliers=Supplier::where('status',1)->get();
            return response()->json($suppliers);
    }


    public function  export_supplier(){
        return Excel::download(new SupplierExport, 'supplier.xlsx');
    }

    public function pdfSupplierPurchase($id){

         $p_items=Purchase::where('supplier_id',$id)->orderBy('id','DESC')->with('purchaseItems')->get();
        
         $supplier=Supplier::where('id',$id)->first();

         $pdf=PDF::loadView('admin.pdf.supplier',compact('p_items','supplier'));
         return $pdf->stream();
    }

    public function pdfSupplierAmount($id){
        $total_paid_items=SupplierPayment::where('supplier_id',$id)->orderBy('date','DESC')->get();
       
         $supplier=Supplier::where('id',$id)->first();
         $pdf=PDF::loadView('admin.pdf.supplierPayment',compact('total_paid_items','supplier'));
         return $pdf->stream();
    }

}

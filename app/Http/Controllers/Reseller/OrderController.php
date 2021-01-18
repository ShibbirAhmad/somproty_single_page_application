<?php

namespace App\Http\Controllers\Reseller;

use App\Models\Courier;
use App\Models\City;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Order_details;
use App\Models\Product;
use App\Models\Product_wise_size;
use App\Models\ResellerPayments;
use App\Models\Size;
use App\Models\SubCity;
use App\Services\FrontEnd\ShoppingCartService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\ProductAttribute;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\ResellerOrderDetails;





class OrderController extends Controller
{
    public function index()
    {
        $couriers = Courier::where('status', 1)->get();
        $orders = Order::where('reseller_id', session()->get('reseller')['id'])->where('order_type', 4)->orderBy('id','desc')->paginate(10);
       
        return view('reseller.order.index', \compact('couriers','orders'));
    }

    public function customerSearch($mobile)
    {


        $customerS = Order::orderBy('id', 'DESC')->where('mobile_no', $mobile)->first();
       // return $customerS;
        // $customerM = Order::orderBy('id','DESC')->where('shipping_mobile_no', $mobile)->first();


        if ($customerS) {
            return response()->json([
                'success' => 'OK',
                'message' => 'Customer Search successfully!',
                'data' => $customerS,
                'date' =>  $customerS->created_at ? null :" sorry. System not saved last order time."
            ]);
        }
    }

    public function productFind($product_code)
    {

        $product_info = Product::where('product_code',$product_code)->where('status',1)->first();
        $product_variant =ProductVariant::where('product_id',$product_info->id)->with('variant')->get();
        if ($product_info) {
            return response()->json([

                'success' => "OK",
                'product' => $product_info,
                'variant' => $product_variant

            ]);
        }


    }


    public function orderSave(Request $request)
    {

  //    return $request->all();
     
        $validator = Validator::make($request->all(), [

          'customer_mobile' => 'required|digits:11 ',
            'customer_name' => 'required ',
            'customer_address' => 'required ',
            'city' => 'required',
            'courier' => 'required',
            'shipping_cost' => 'required',
            'details_in' => 'required',
             'commission' => 'required',

        ]);


        if(!$validator->fails()){
        //first find find the customer
        $customer=Customer::where('phone',$request->customer_mobile)->first();

        //if not customer then save, as a new customer
        if(!$customer){
            $customer=new Customer();
            $customer->name=$request->customer_name;
            $customer->phone=$request->customer_mobile;
            $customer->address=$request->customer_address;
            $customer->city_id=$request->city;

            $customer->save();
        }

        $id = Order::max('id') ?? 0;
        $invoice = 41151 + $id;
        $order=new Order();
        $order->customer_id=$customer->id;
        $order->cutomer_phone=$request->customer_mobile;
        $order->invoice_no=$invoice;
        $order->order_type=4;
        $order->city_id=$request->city;
        $order->courier_id=$request->courier;
        $order->shipping_cost=$request->shipping_cost ?? 0;
        $order->discount=$request->discount ?? 0;
        $order->paid=$request->payable??0;
        $order->total=$request->total_amount;
        $order->status=1;
        $order->reseller_id=session()->get('reseller')['id'];
        if ($order->save()) {
                $data = array();
                $detaisl = new  OrderItem();
                foreach ($request->details_in as $product) {

                    //  $product_stock=Product::where('id',$product['product_id'])->first();
                    //     $product_stock->stock=$product_stock->stock-$product['quantity'];
                    
                     $data = array([
                        'order_id' =>$order->id,
                        'product_id' => $product['product_id'],
                        'attribute_id' => null,
                        'variant_id' => $product['variant_id'] ?? null,
                        'quantity' => $product['quantity'],
                        'price' => $product['sale_price'],
                        'total'=>$product['quantity']* $product['sale_price'],
                      //  'reseller_commission_percent' => $product['reseller_commission_percent'] ?? null,
                    ]);
               
                    $detaisl->insert($data);
                }

                if (isset($data)){
                   $resellerOrderDetails=new ResellerOrderDetails();
                    $resellerOrderDetails->order_id=$order->id;
                    $resellerOrderDetails->reseller_id=session()->get('reseller')['id'] ?? null;
                    $resellerOrderDetails->total_percent=$request->commission;
                    $resellerOrderDetails->total_amount=$request->reseller_amount_percent;
                    $resellerOrderDetails->paid=null;
                    $resellerOrderDetails->paid_date=null;
                    $resellerOrderDetails->advance= $request->payable ?? 00;
                    $resellerOrderDetails->order_total=  $request->total_amount;
                    $resellerOrderDetails->shipping_cost= $request->shipping_cost;
                    if ($resellerOrderDetails->save()){
                        ////Order Details Save Check
                        $number = $request->mobile;
                        $name = $request->user_name;
                        $id = $order->invoice_no;
                       // ShoppingCartService::SendMessageCustomer($number, $name, $id); //// Send Message Customer
                       return response()->json([
                            'success'=>"OK"
                       ]);
                    }
                }
            }
        }
          return response()->json([
            'success' => 'FALD',
            'errors' => $validator->errors()->all()
        ]);

       
    }

   public  function orderView($id){
    
            $order=Order::find($id);
          

            if ($order){
                 $orderResellerDetails=ResellerOrderDetails::where('reseller_id',session()->get('reseller')['id'])->where('order_id',$order->id)->first();
               return view('reseller.order.view',\compact('order','orderResellerDetails'));
            }
        }
        
        
    public  function cancelOrder($id){

        $order=Order::find($id);
        $order->status=6;
        if ($order->save()){
            return  back()->with('message','Order Cancel Successfully');
        }
    }
    
     public function payment()
    {
        $payments = ResellerPayments::where('reseller_id', session()->get('reseller')['id'])->orderBy('id', 'DESC')->paginate(10);
        return view('reseller.order.payment', \compact('payments'));

    }

    public function paymentDetails($id){
        $details = ResellerOrderDetails::whereNotNull('paid_invoice_no')->where('paid_invoice_no', $id)->where('paid', 1)->get();
        $payment = ResellerPayments::find($id);
        return view('reseller.order.paymentDetails', \compact('details', 'payment'));

    }

    
        public  function orderSearch(Request $request){


        if (!empty($request->status)){
          $orders=Order::where('reseller_id',session()->get('reseller')['id'])->where('order_type',4)->where('status',$request->status)->paginate(10);
         
        }

        elseif (!empty($request->invoiceOrPhone)){
           $data=strlen($request->invoiceOrPhone);
          
           if ($data==11){
             //  return $request->invoiceOrPhone;
               $orders=Order::where('reseller_id',session()->get('reseller')['id'])->where('order_type',4)->where('mobile_no',$request->invoiceOrPhone)->paginate(10);

           }
               else{
                 $orders=Order::where('reseller_id',session()->get('reseller')['id'])->where('order_type',4)->where('invoice_no',$request->invoiceOrPhone)->paginate(10);

               }    
            }
        
        
        if(empty($orders)){
           return back()->with('message','sorry ! we cound not find any thing.');
        }
        $appendData['status'] = $request->status;
        $appendData['invoiceOrPhone'] = $request->invoiceOrPhone;
        $couriers = Courier::where('status', 1)->get();
        return view('reseller.order.index', \compact('couriers','orders','appendData'));
    }
   public  function create(){
        $couriers = Courier::where('status', 1)->get();
        return view('reseller.order.create', \compact('couriers'));
    }
    
      public  function wholeSale(){
        $couriers = Courier::where('status', 1)->get();
        return view('reseller.order.wholesale', \compact('couriers'));
    }

    public function attributeWisevariant($id){

    }


}

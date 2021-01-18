<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <router-link :to="{ name: 'PaymentInvoice' }" class="btn btn-primary"
            ><i class="fa fa-arraw-angle-right"></i
          ></router-link>
        </h1>
        <ol class="breadcrumb">
          <li>
            <a href="#"><i class="fa fa-dashboard"></i>Dashboard</a>
          </li>
          <li class="active">Reseller</li>
        </ol>
      </section>

      <section class="content">
        <div class="container">
          <div class="row">
            <div class="col-lg-11">
              <div class="box box-primary">
                <div class="box-header with-border">
                 
                </div>

                <div class="box-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Invoie No:</th>
                        <th>Order Total</th>
                         <th>Reseller Commision</th>
                         <th>Advance</th>
                         <th>Order Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="(payment_item,
                        index) in payment_items"
                        :key="index"
                      >
                        <td>
                            {{ index+1 }}
                        </td>
                        <td>{{ payment_item.order.invoice_no}}</td>
                          <td>
                             {{parseInt(payment_item.order.total)-parseInt(payment_item.order.discount)+parseInt(payment_item.order.shipping_cost)}}
                         </td>
                         
                          <td>
                             {{payment_item.total_amount}}
                         </td>
                           <td>
                             {{payment_item.order.paid}}
                         </td>
                         <td>
                             {{payment_item.order.created_at}}
                         </td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="row">
                  <div class="summary">
                      <div class="col-lg-5">
                     <dl class="row">
                      <dt class="col-sm-6">Total Order Count:</dt>
                      <dd class="col-sm-6"><strong>{{ payment_items.length }}</strong></dd>
                       <dt class="col-sm-6">Total order amount (BDT):</dt>
                      <dd class="col-sm-6"><strong>{{total('order_amount')}}</strong></dd><br>
                       <dt class="col-sm-6">Total Reseller commission Amount (BDT):</dt>
                      <dd class="col-sm-6"><strong>{{ payment.paid_amount }}</strong></dd>

                </dl>
              </div>
                <div class="col-lg-5">
                     <dl class="row">
                      <dt class="col-sm-6">Payment Invoice No:</dt>
                      <dd class="col-sm-6"><strong>{{"RSPAY-"+payment.id}}</strong></dd>
                       <dt class="col-sm-6">Total Amount (BDT):</dt>
                      <dd class="col-sm-6"><strong>{{ payment.paid_amount }}</strong></dd><br>
                       <dt class="col-sm-6">Total Advance Amount (BDT):</dt>
                      <dd class="col-sm-6"><strong>{{total('order_advance_amount') }}</strong></dd><br>
                      <dt class="col-sm-6">Issue Date:</dt>
                      <dd class="col-sm-6"><strong>{{payment.created_at }}</strong></dd>

                </dl>
              </div>
                    </div>  
                  
                  </div>
                </div>
              
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</template>




<script>
export default {
  mounted() {
   this. getInvoice();
  },

  data() {
    return {
      invoice_list: {},
      payment_items:'',
      payment:'',
      loading: true,
      item: 10,
      reseller_id:'',
      id:[],
      action:'',
     };
  },

  methods: {
    getInvoice(page = 1) {
      axios
        .get("/api/details/payment/invoice/"+this.$route.params.id)
        .then((resp) => {
          console.log(resp)
            if(resp.data){
                this.payment=resp.data.payment;
                this.payment_items=resp.data.payment_items;
            }
            this.loading=false;
        })
      
    },
    total(x){
      let total=0;

      
        this. payment_items. forEach(element => {
          if(x=='order_amount'){
            total+=parseInt(element.order.total)-parseInt(element.order.discount)+parseInt(element.order.shipping_cost);

          }
          
          if(x=='order_advance_amount'){
           total+=parseInt(element.order.paid);

          }
        });
     
      return total;
    }
  
   
 },
 
};
</script>



<style scoped>
.dropbtn {
  width: 100% !important;
  margin-bottom: 5px !important;
}
.dropbtn-active {
  display: block !important;
}
.dropdown-action {
  display: none;
  width: 90px;
  position: absolute;
}
.summary {
    background: #eee!important;
    width: 1020px;
    height: 200px;
    margin-left: 14px;
    margin-top: 15px;
    padding: 12px;
}
</style>

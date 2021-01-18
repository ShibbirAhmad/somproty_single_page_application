<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <loading :active.sync="isLoading" :can-cancel="true" :is-full-page="fullPage"></loading>

      <section class="content-header"></section>
      <section class="content">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-11">
              <div class="box box-primary">
                <div class="box-header"></div>
                <div class="box-body">
                    <div class="row print_info_container">
                    <div class="col-md-1 col-sm-1"> </div>
                    <div class="col-md-3 col-sm-3 description">
                    <div>
                       <p 
                      >Name: {{order.customer.name}}  </p>
                      <p > 
                        Mobile No: <strong> {{order.cutomer_phone}} </strong> 
                      </p>
                      <p class="address_line" >
                        Address:  {{order.customer.address +', ' + order.city.name}}
                      </p>
                      <p >Invoice No: <strong> {{order.invoice_no}} </strong> </p>
        
             
                    </div>
            
                   </div>

                    <div class="col-md-3 col-sm-3 logo"> <img :src="base_url +'images/mohasagor_logo.png'" class="m_logo" alt="logo">
                           <p class="m_title"> Trusted Onlinde Shopping In Bangladesh </p>
                     </div>
                    <div style="margin-left:27px" class="col-md-4 col-sm-4 address"> 
                        <!-- <p class="address_line" >Office: Houes:02, Lane:11,Block:A, Banarosi Polli, <br/>
                          section-10, Mirpur,Dhaka.</p>
                        <p>Email: support@mohasagor.com</p>
                        <p>Hot Line: <strong> 09636 203040</strong>  </p>
                        <p >
                        Date: {{formateDate( order.created_at) }}
                      </p> -->

                      <div class="form-group" v-if="order.order_type==4 && Object.keys(order.reseller_order_details).length">
                        <label for="">Reseller Commision</label>
                        <div style="display:flex;">
                          <input type="text" id="reseller_order_commision" :value="order.reseller_order_details.total_amount" class="form-control" >
                          <button class="btn btn-primary text-uppercase" @click="updateResellerCommision">update</button>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-1 col-sm-1"> </div>
                  </div>


                  <div class="row">
                    <div class="col-lg-1"></div>
                    <h1 v-if="isLoading">
                      <i class="fa fa-spin fa-spinner"></i>
                    </h1>
                    <div class="col-lg-10" v-else>
                      <table class="table">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th>Image</th>
                            <th>Size</th>
                            <th>P_code</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th  v-if="order.status==4"></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(item,index) in items " :key="index">
                            <td>{{index+1}}
                             
                            </td>
                            <td>
                              {{ item.product.name}}
                               <div  v-if="order.status==4 || order.status==5">
                                <small   v-if="item.status==2"   class="badge badge-danger">Returned</small>
                              <!-- <small   v-else   class="badge badge-success">Delivered</small> -->

                              </div>
                              <!-- <strong v-if="item.attribute">-{{item.attribute.name}}<b v-if="item.variant">[{{item.variant.name }}]</b></strong> -->
                            </td>
                            <td>
                              <img v-if="item.product.product_image.length>0" :src="base_url+item.product.product_image[0].product_image" style="width:60px;height:50px;">
                            </td>
                            <td>
                                <strong>
                                    <b v-if="item.variant">[{{item.variant.name }}]</b>
                                      <b v-else>-</b>
                                    
                                </strong>
                            </td>
                            <td>{{ item.product.product_code }}</td>
                            <td>{{item.quantity}}</td>
                            <td>{{item.price}}</td>
                            <td>{{item.quantity*item.price}}</td>
                            <td v-if="order.status==4 && item.status==1"><span class="badge badge-danger" style="cursor: pointer;" @click="itemReturn(item.id)">Return</span></td>
                          </tr>

                          <tr>
                            <td colspan="6"></td>
                            <td>
                              <b>Sub Total</b>
                            </td>
                            <td>
                              <b>{{order.total}}</b>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="6"></td>
                            <td>
                              <b>Discount</b>
                            </td>
                            <td>
                              <b>{{order.discount}}</b>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="6"></td>
                            <td>
                              <b>Paid</b>
                            </td>
                            <td>
                              <b>{{order.paid}}</b>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="6"></td>
                            <td>
                              <b>Shiiping_cost</b>
                            </td>
                            <td>
                              <b>{{order.shipping_cost}}</b>
                            </td>
                          </tr>

                          <tr>
                            <td colspan="6"></td>
                            <td>
                              <b>Amount Due</b>
                            </td>
                            <td>
                              <b>{{parseInt(order.total)-(parseInt(order.discount)+parseInt(order.paid))+parseInt(order.shipping_cost)}}</b>

                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-2" style="margin-left:27px;text-align:center;">
                      <h6
                        style="margin-bottom:0;"
                        v-if="order.approved_by != null"
                      >{{order.approved_by.name}}</h6>
                      <h5 style="border-top:2px dotted #000;margin-top:25;">
                        <strong>Approved By</strong>
                      </h5>
                    </div>
                  </div>

                  <div class="row bottomBtn">
                    <button class="btn btn-success print"  @click="print(order.id)">
                      <i class="fa fa-print"></i>
                    </button>
                    <button class="btn btn-warning back" @click="back">
                      <i class="fa fa-arrow-circle-right" ></i>
                    </button>
                     <router-link class="btn btn-success back" :to="{name:'orderEdit',params:{id:order.id}}" v-if="order.status!=5 && order.status!=4">
                      <i class="fa fa-edit" ></i>
                    </router-link>
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
import Vue from "vue";
import { Form, HasError, AlertError } from "vform";
import Loading from "vue-loading-overlay";

export default {
  created() {
    this.getDetails();
    
  },
  data() {
    return {
      order: "",
      items: "",
      loading: true,
     base_url: this.$store.state.image_base_link,
      isLoading: true,
      fullPage: true,

    };
  },

  methods: {
    getDetails() {
      axios
        .get("/order/view/" + this.$route.params.id)
        .then((resp) => {
          console.log(resp);
          if (resp.data.status == "SUCCESS") {
            this.order = resp.data.order;
            this.items = resp.data.items;
            this.isLoading=false;
          } else {
            this.$toasted.show("some thing want to wrong", {
              type: "error",
              position: "top-center",
              duration: 5000,
            });
          }
        })
        .catch((error) => {
          console.log(error);
          this.$toasted.show("some thing want to wrong", {
            type: "error",
            position: "top-center",
            duration: 4000,
          });
        });
    },
    print(order_id) {
     window.open('/order/invoice/print/'+order_id,'_SELF')
 
    },
    back() {
      //   console.log(window.history);
      window.history.back();
    },
    formateDate(date){

      let d=new Date(date);
      let month = d.getMonth();
      let day = d.getDate();
      let year= d.getFullYear();
      let output=((""+day).length < 2 ? "0" : "")+day + "-" + ((""+month).length < 2 ? "0" : "")+month + "-" + year  ;
      return output;
    
    },
    updateResellerCommision(){
      
      let commission=document.getElementById('reseller_order_commision').value;
      if(parseInt(commission)<=0){
        console.log(commission);
        alert('Commison can not be equal or smaller 0');
        return;
      }
      axios.get('/update/commision/reseller/order/'+this.order.id,{
        params:{
          commission
        }
      }).then(resp=>{
        if(resp.data){
          this.$toasted.show(resp.data, {
              type: "info",
              position: "top-center",
              duration: 5000,
            });
        }
      })
  


    },
    itemReturn(item_id){
    
      if(confirm("are you confirm")){
        this.isLoading=true;
       axios.get('/order/return/item/'+item_id)
       .then(resp=>{
         console.log(resp)
         if(resp.data.success=="OK"){
             this.$toasted.show(resp.data.message, {
              type: "info",
              position: "top-center",
              duration: 5000,
            });
            this.getDetails();
         }else{
             this.$toasted.show(resp.data, {
              type: "error",
              position: "top-center",
              duration: 5000,
            });
         }
       })
       .catch(e=>{
         this.isLoading=false;
       })
      }
      
    }
  },
components:{
  Loading
}
};
</script>

<style scoped>

.mb-2 {
  margin-bottom: 5px !important;
}
.bottomBtn {
  margin-top: 15px;
  margin-left: 20px;
}
.head_title{
    margin-left: 27px;
    margin-top: -12px;
}
.address_line{
  line-height: 15px;
}
p { 
  line-height: 10px;
  font-size:14px;
}
.m_logo{
    margin-left: -11px;
    margin-top: -21px;
    height: 80px;
}
.m_title{
  margin-top:-15px;
  font-size: 11px;
}
table {
  margin-top:20px;
}
@media print {

  *{
    margin: 0;
    padding: 0;
  }
  
  table {
  margin-top:20px !important;
}

 .m_title{
    margin-top:-15px;
   font-size: 10px;
 }
  .navbar {
    display: none;
  }
  .m_logo{
    height: 80px;
   }
  .print_info_container{
    display: flex;
    flex-direction: row;
    position: relative;
    width: 100%;
    padding: 10px 10px  !important;
    margin-top: 20px;
  }
  .col-sm-1{
    display: none;
  }
  .address_line{
  line-height: 15px;
  }
  p{ 
    line-height: 16px;
    font-size: 14px;
  } 
.logo{
      width: 40% !important;
    
  }

 .description{
   width: 40%  !important;
 }
  .col-lg-2 {
    width: 20% !important;
    margin-top: 20px !important;
  }
  .invoice-header {
    display: block;
  }
  .box {
    border-top: none;
  }
  footer {
    border-top: none !important;
  }
  .bottomBtn {
    display: none;
  }
}
small.badge.badge-danger {
    display: flex;
    background: red;
    width: 63px;
    flex-direction: row;
}
small.badge.badge-success {
    display: flex;
    background: green;
    width: 63px;
}
</style>

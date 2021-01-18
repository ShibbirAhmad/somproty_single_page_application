<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <router-link :to="{ name: 'addOrder' }" class="btn btn-primary">
            <i class="fa fa-plus"></i>
          </router-link>
          <router-link :to="{name:'NewOrder'}" class="btn btn-sm btn-success active">New</router-link>
          <router-link :to="{name:'PendingOrder'}" class="btn btn-sm btn-success">Pending</router-link>
          <router-link :to="{name:'ApprovedOrder'}" class="btn btn-sm btn-success">Approved</router-link>
          <router-link :to="{name:'ShipmentOrder'}" class="btn btn-sm btn-success">Shipment</router-link>
          <router-link :to="{name:'DeliveredOrder'}" class="btn btn-sm btn-success">Delivered</router-link>

          <router-link :to="{name:'ReturnOrder'}" class="btn btn-sm btn-success">Return</router-link>
          <router-link :to="{name:'CancelOrder'}" class="btn btn-sm btn-success">Cancel</router-link>
          <router-link :to="{name:'WholeSaleOrder'}" class="btn btn-sm btn-success ">whole sale</router-link>

          <router-link :to="{name:'order'}" class="btn btn-sm btn-success ">All</router-link>


        </h1>
        <ol class="breadcrumb">
          <li>
            <a href="#"> <i class="fa fa-dashboard"></i>Dashboard </a>
          </li>
          <li class="active">All Order</li>
        </ol>
      </section>
      <section class="content">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-11">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <div class="row" style="margin-bottom:3px;">
                    <div class="col-lg-3">
                      <select name="" id="" v-model="bulkActionType" class="form-control">
                        <option  value="0" selected  disabled>Select Action</option>
                        
                           <option value="LABEL PRINT">Label Print</option>
                         <option value="INVOICE PRINT">Invoice Print</option>
                        <option value="PENDING ALL">Pending All</option>
                        <option value="APPROVED ALL">Approved All </option>
                        <option value="CANCEL ALL">Cencel ALl</option>
                       
                       
                    </select>
                    </div>
                    <div class="col-lg-4 col-lg-offset-1 orders-heading">
                      <h3 class="box-title">{{ heading }}</h3>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-2">
                      <select
                        class="form-control"
                        v-model="type"
                        @change="ordersList"
                      >
                        <option value="all">All type</option>
                        <option value="2">Onely Admin</option>
                        <option value="1">Only Customer</option>
                        <option value="3">Whole Sale</option>
                        <option value="4">Only Reseller</option>
                      </select>
                    </div>
                    <div class="col-lg-2">
                      <select
                        class="form-control"
                        v-model="status"
                        @change="ordersList"
                      >
                        <option value="all">All</option>
                        <option value="1">New</option>
                        <option value="2">Pending</option>
                        <option value="3">Approved</option>
                        <option value="4">Shipment</option>
                        <option value="5">Delivired</option>
                        <option value="7">Retrun</option>
                        <option value="6">Cancel</option>
                      </select>
                    </div>
                    <div class="col-lg-2">
                      <input
                        class="form-control"
                        @keyup="orderSearch"
                        v-model="search"
                        placeholder="Enter Invoice,Cutomer_phone"
                      />
                    </div>
                    <div class="col-lg-4">
                      <form @submit.prevent="filterOrder">
                        <div class="row">
                          <div class="col-lg-4">
                            <date-picker
                              autocomplete="off"
                              v-model="start_date"
                              placeholder="start-date"
                              :config="options"
                            ></date-picker>
                          </div>
                          <div class="col-lg-4" style="margin-left: -20px">
                            <date-picker
                              autocomplete="off"
                              v-model="end_date"
                              placeholder="end-date"
                              :config="options"
                            ></date-picker>
                          </div>
                          <div class="col-lg-4">
                           <select class="form-control" v-model="courier_id" style="width:120px;">
                             <option value="" selected disabled>Select Courier</option>
                             <option v-for="courier in couriers" :value="courier.id" :key="courier.id">{{courier.name}}</option>
                           </select>
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="col-lg-1">
                      <button
                        @click="resetAll"
                        style="margin-left: 45px"
                        type="button"
                        class="btn btn-primary btn-sm"
                      >
                        <i class="fa fa-refresh"></i>
                      </button>
                    </div>

                    <div class="col-lg-1">
                      <select
                        class="form-control"
                        v-model="item"
                        v-if="start_date.length > 0"
                        @change="filterOrder"
                       > 
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                      </select>
                       <select  class="form-control" v-model="item" v-else @change="ordersList">
                     
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="box-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">
                          <input type="checkbox" @click="selectAll" />
                        </th>
                        <th scope="col">customer_name</th>
                        <th scope="col">C_phone</th>
                        <th scope="col">C_address</th>

                        <th scope="col">Invoice</th>
                        <th scope="col">Total</th>
                        <th scope="col">Create_by</th>
                        <th scope="col" style="width: 2%">Order_place</th>
                        <th>Order_date</th>

                        <th>Action</th>
                        <!-- <th>Courier</th> -->
                        <th>CMNT</th>
                      </tr>
                    </thead>
                    <tbody>
                      <h1 v-if="loading">
                        <i class="fa fa-spin fa-spinner"></i>
                      </h1>

                      <tr
                        v-else
                        v-for="(order, index) in orders.data"
                        :key="index"
                      >
                        <td style="width: 1%">
                          <input
                            type="checkbox"
                            class="select-all"
                            v-model="select_order_id"
                            :value="order.id"
                          />
                        </td>
                        <td class="three-percent">{{ order.customer ? order.customer.name : '' }}</td>
                        <td class="three-percent">
                          {{  order.cutomer_phone  }}
                        </td>
                        <td class="three-percent">
                          {{  order.customer ? order.customer.address : "" }}
                        </td>
                        <td class="two-percent">{{ order.invoice_no }}</td>
                        <td class="two-percent">
                           <strong>
                            Total: {{parseInt(order.total)-parseInt(order.discount)+parseInt(order.shipping_cost)}}

                          </strong>
                          <strong>
                            P: {{parseInt(order.paid)}}

                          </strong>
                          <strong>
                            D: {{parseInt(order.total)-(parseInt(order.discount)+parseInt(order.paid))+parseInt(order.shipping_cost)}}

                          </strong>
                        </td>
                        <td class="two-percent">
                          <p v-if="order.order_type == 1">customer</p>
                          <p v-if="order.order_type == 2">
                            Admin ||
                            <strong>{{ order.create_admin.name }}</strong>
                          </p>
                          <p v-if="order.order_type == 3">
                            Whole sale ||
                            <strong>{{ order.create_admin.name }}</strong>
                          </p>
                          <p v-if="order.order_type == 4">
                            Reseller <strong v-if="order.reseller.username">{{order.reseller.username}}</strong>
                          </p>
                        </td>
                        <td class="two-percent">
                          <span class="badge" v-if="order.status == 1">New</span>
                          <span class="badge" v-if="order.status == 2">Pending</span>

                          <span
                            class="badge badge-success"
                            v-if="order.status == 3"
                            >Approved</span
                          >
                          <span
                            class="badge badge-success"
                            v-if="order.status == 4"
                            >Shipment</span
                          >
                          <span
                            class="badge badge-warning"
                            v-if="order.status == 5"
                            >Delivered</span
                          >
                          <span
                            class="badge badge-danger"
                            v-if="order.status == 6"
                            >Cancel</span
                          >
                          <span
                            class="badge badge-danger"
                            v-if="order.status == 7"
                            >Return</span
                          >
                        </td>
                        <td class="two-percent">{{ order.created_at }}</td>
                        <td>
                          <button
                            class="btn btn-sm btn-success action-btn"
                            v-if="
                              order.status == 2 ||
                              order.status == 1 ||
                              order.status == 6
                            "
                            @click="approved(order, index)"
                          >
                            Approved
                          </button>
                          <button
                            class="btn btn-sm btn-info action-btn"
                            v-if="
                              order.status == 1 ||
                              order.status == 7 ||
                              order.status == 2
                            "
                            @click="pending(order, index)"
                          >
                            Pending
                          </button>
                          <button
                            class="btn btn-sm btn-success action-btn"
                            v-if="order.status == 4"
                            @click="delivered(order, index)"
                          >
                            Deliverd
                          </button>
                          <button
                            class="btn btn-sm btn-primary action-btn"
                            v-if="order.status == 3"
                            @click="shipment(order, index)"
                          >
                            Shipment
                          </button>
                          <button
                            class="btn btn-sm btn-danger action-btn"
                            v-if="
                              order.status == 1 ||
                              order.status == 2 ||
                              order.status == 3
                            "
                            @click="cancel(order, index)"
                          >
                            Cancel
                          </button>
                          <button
                            class="btn btn-sm btn-warning action-btn"
                            v-if="order.status == 4"
                            @click="returnOrder(order, index)"
                          >
                            Return
                          </button>

                          <router-link class="btn btn-sm btn-warning" :to="{name:'orderEdit',params:{id:order.id}}">Edit</router-link>

                          <router-link
                            class="btn btn-sm btn-primary action-btn"
                            style="color: #fff"
                            :to="{
                              name: 'viewOrder',
                              params: { id: order.id },
                            }"
                            >View</router-link
                          >
                        </td>
                        <!-- <td style="width:1%;">
                          <small v-if="order.courier_id">{{
                            order.courier.name
                          }}</small>
                          <span class="badge" if="order.memo_no">{{
                            order.memo_no
                          }}</span>
                         
                         
                            <i class="fa fa-edit"  @click="courierModal(order, index)"></i>
                        
                        </td> -->
                        <td>
                          <a href="#" @click="comment(order.id, index,order.comment)">CO</a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="box-footer">
                  <div class="row">
                    <div class="col-lg-6">
                     

                      <pagination
                        :data="orders"
                        @pagination-change-page="ordersList"
                        :limit="5"
                      ></pagination>
                    </div>
                    <div
                      class="col-lg-6 mt-1"
                      style="margin-top: 25px; text-align: right"
                    >
                      <p>
                        Showing
                        <strong>{{ orders.from }}</strong> to
                        <strong>{{ orders.to }}</strong> of total
                        <strong>{{ orders.total }}</strong> entries
                      </p>
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
import Index from "../Index";
import { Form } from "vform";

export default {
  components: { Index },

  created() {
   this.ordersList();
   this.others();
  },
  data() {
    return {
      orders: {},
      loading: true,
      item: "10",
      courier: {
        order_id: "",
        courier_id: "",
        memo_no: "",
        order_index: "",
      },
      couriers: "",
      comments:'',
      search: "",
      start_date: "",
      end_date: "",

      //date picker options ..........
      options: {
        format: "YYYY-MM-DD",
        useCurrent: false,
      },
      status: 1,
      type: "all",
      page: 1,
      selected: false,

      //for biblk action
      select_order_id: [],
      bulk_status: "all",

      //heading in table
      heading: "All Order",

      bulkActionType:"0",

      //for filtaring order
      courier_id:'',
    };
  },
  methods: {
    //get order list
    ordersList(page = 1) {
      //start progress bar
      this.$Progress.start();
      axios
        .get("/orders?page=" + page, {
          params: {
            //send data
            status: this.status,
            item: this.item,
            type: this.type,
            start_date:this.start_date,
            end_date:this.end_date,
            courier_id:this.courier_id,
          },
        })
        .then((resp) => {
          console.log(resp);
          // console.log(resp);

          //finish progress bar after resp
          this.$Progress.finish();

          //only success resp
          if (resp.data.status == "SUCCESS") {
            this.orders = resp.data.orders;
            this.loading = false;
            this.page = this.page + 1;
            this.loading=false;
          }

          //else show a error
          else {
            this.$toasted.show("some thing want to wrong", {
              type: "error",
              position: "top-center",
              duration: 5000,
            });
          }
        })
        .catch((error) => {
          //finish progress bar after resp
          this.$Progress.finish();
          this.$toasted.show("some thing want to wrong", {
            type: "error",
            position: "top-center",
            duration: 4000,
          });
        });
    },

    //initail others method for get courier list
    others() {
      axios.get("/others").then((resp) => {
        //only success resp
        console.log(resp)
        if (resp.data.status == "SUCCESS") {
          this.couriers = resp.data.couriers;
          this.comments=resp.data.comments;;
        }
      });
    },

    //initial method for order approved
    approved(order, index) {
      /////index initial for update order from orderLit or order arrow.

      //start progress bar
      this.$Progress.start();
      axios
        .get("/approved/order/" + order.id)
        .then((resp) => {
          //end progress bar after resp
          this.$Progress.finish();

          //if resp success then....
          if (resp.data.status == "SUCCESS") {
            this.$toasted.show(resp.data.message, {
              type: "success",
              position: "top-center",
              duration: 2000,
            });
            this.orders.data[index].status = 3;
          }
          //not resp success.....
          else {
            this.$toasted.show("some thing want to wrong", {
              type: "error",
              position: "top-center",
              duration: 2000,
            });
          }
        })
        .catch((error) => {
          //end progress bar after resp
          this.$toasted.show("some thing want to wrong", {
            type: "error",
            position: "top-center",
            duration: 4000,
          });
        });
    },

    //initial method for order cancel

    cancel(order, index) {
      /////index initial for update order from orderLit or order arrow.

      //start progress bar
      this.$Progress.start();
      axios
        .get("/cancel/order/" + order.id)
        .then((resp) => {
          //end progress bar after resp
          this.$Progress.finish();

          //only success resp .......
          if (resp.data.status == "SUCCESS") {
            this.$toasted.show(resp.data.message, {
              type: "success",
              position: "top-center",
              duration: 2000,
            });
            this.orders.data[index].status = 6;
          }
          //for any kind of error resp .......
          else {
            this.$toasted.show("some thing want to wrong", {
              type: "error",
              position: "top-center",
              duration: 2000,
            });
          }
        })
        .catch((error) => {
          //end progress bar after resp
          this.$toasted.show("some thing want to wrong", {
            type: "error",
            position: "top-center",
            duration: 4000,
          });
        });
    },

    //initial method for order return

    returnOrder(order, index) {
      /////index initial for update order from orderLit or order arrow.

      //start progress bar
      this.$Progress.start();
      axios
        .get("/return/order/" + order.id)
        .then((resp) => {
          console.log(resp);
          //end progress bar after resp
          this.$Progress.finish();

          //only success resp .......
          if (resp.data.status == "SUCCESS") {
            this.$toasted.show(resp.data.message, {
              type: "success",
              position: "top-center",
              duration: 2000,
            });
            this.orders.data[index].status = 7;
          }
          //for any kind off error resp
          else {
            this.$toasted.show("some thing want to wrong", {
              type: "error",
              position: "top-center",
              duration: 2000,
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

    delivered(order, index) {
      /////index initial for update order from orderLit or order arrow.

      //start progress bar
      this.$Progress.start();
      axios
        .get("/delivered/order/" + order.id)
        .then((resp) => {
          console.log(resp);
          //end progress bar after resp
          this.$Progress.finish();

          //only success resp .......
          if (resp.data.status == "SUCCESS") {
            this.$toasted.show(resp.data.message, {
              type: "success",
              position: "top-center",
              duration: 2000,
            });
            this.orders.data[index].status = 5;
          }
          //any kind of error resp
          else {
            this.$toasted.show("some thing want to wrong", {
              type: "error",
              position: "top-center",
              duration: 2000,
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

    shipment(order, index) {
      /////index initial for update order from orderLit or order arrow.

      //start progress bar
      this.$Progress.start();
      axios
        .get("/shipment/order/" + order.id)
        .then((resp) => {
          console.log(resp);
          //end progress bar after resp
          this.$Progress.finish();

          //only success resp .......
          if (resp.data.status == "SUCCESS") {
            this.$toasted.show(resp.data.message, {
              type: "success",
              position: "top-center",
              duration: 2000,
            });
            this.orders.data[index].status = 4;
          }
          //any kind of error resp
          else {
            this.$Progress.finish();

            this.$toasted.show("some thing want to wrong", {
              type: "error",
              position: "top-center",
              duration: 2000,
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

    pending(order, index) {
      /////index initial for update order from orderLit or order arrow.

      //start progress bar
      this.$Progress.start();
      axios
        .get("/pending/order/" + order.id)
        .then((resp) => {
          console.log(resp);
          //end progress bar after resp
          this.$Progress.finish();

          //only success resp .......
          if (resp.data.status == "SUCCESS") {
            this.$toasted.show(resp.data.message, {
              type: "success",
              position: "top-center",
              duration: 2000,
            });
            this.orders.data[index].status = 2;
          }
          //any kibd off error resp
          else {
            this.$Progress.finish();

            this.$toasted.show("some thing want to wrong", {
              type: "error",
              position: "top-center",
              duration: 2000,
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

    //method initial for order search
    orderSearch(page = 1) {
      //if search lenght minimum 2
      if (this.search.length > 1) {
        //show loader
        this.loading = true;

        //fetch data
        axios
          .get("/order/search/" + this.search + "?page=" + page)

          .then((resp) => {
            //if success resp
            if (resp.data.status == "SUCCESS") {
              this.orders = resp.data.orders;
              this.loading = false;
            }
          })
          //for any kind of error
          .catch((error) => {
            console.log(error);
            alert("some thing want wrong");
          });
      }
      //if search lenght smaller then 2, then excute orderist method .......
      else {
        this.loading = false;
        this.ordersList();
      }
    },

    //method initial for filter order, data to date, and single data......
    filterOrder(page = 1) {
      //start progressbar
      this.$Progress.start();

      //show loader
      this.loading = true;

      //fetch data
      axios
        .get("/order/filter?page=" + page, {
          //send data
          params: {
            start_date: this.start_date,
            end_date: this.end_date,
            item:this.item,
            status:this.status
          },
        })
        .then((resp) => {
          //only success resp ........
          this.$Progress.finish();
          this.loading = false;
          if (resp.data.status == "SUCCESS") {
            this.orders = resp.data.orders;
            this.loading = false;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    //method initial for rest all data, or order arrow
    resetAll() {
     location.reload();
    },

    //method inital for select all
    selectAll() {
      //first idnetify select true or false
      //we need a tooglee all select box

      //if select true we make selected false, or select true
      if (this.selected == true) {
        this.selected = false;
      } else {
        this.selected = true;
      }

      //elemnt find by the class name
      let checkBoxClass = document.getElementsByClassName("select-all");

      for (let i = 0; i < checkBoxClass.length; i++) {
        //if select active then element set attribute check==true
        //element set attribute check==false
        if (this.selected == true) {
          checkBoxClass[i].checked = true;
        } else {
          checkBoxClass[i].checked = false;
        }
      }

      //at last push order id in selected_order_id arrow....
      //and agin check selected true or false.....
      if (this.selected == true) {
        for (let i = 0; i < this.orders.data.length; i++) {
          this.select_order_id.push(this.orders.data[i].id);
        }
      } else {
        this.select_order_id = [];
      }
    },

    //method inital for a bulk action
    selectBulkAction() {
     if(this.select_order_id.length<=0){
       Swal.fire({
         type:'warning',
         text:'Please select at least one row'
       })
       return ;
       
     }
     let action_type=this.bulkActionType;
      if(action_type=='LABEL PRINT'){
          window.open('/order/label/print/'+this.select_order_id,'_blank')
      }
       if(action_type=='INVOICE PRINT'){
          window.open('/order/invoice/print/'+this.select_order_id,'_blank')
      }

     if(action_type=='PENDING ALL'){
        if(confirm("are you sure")){
           this.pendingAll(this.select_order_id);
        }
        return;
     }

      if(action_type=="APPROVED ALL"){
         if(confirm("are you sure")){
         this.apprvedAll(this.select_order_id);
        }
        return;
      }
    
    

     if(action_type=='CANCEL ALL'){
        if(confirm("are you sure")){
           this.cancelAll(this.select_order_id);
        }
        return;
     }
    
   },

    labelPrint(){
      window.open('','_self',"width=600,height=600");
    },
  apprvedAll(order_id){
    axios.get('/approved/all/order/'+order_id)
         .then(resp=>{
            if(resp.data){
            
              this.$toasted.show(resp.data, {
              type: "success",
              position: "top-center",
              duration: 2000,
            });
            this.$router.push({name:"ApprovedOrder"})
            }
         })
         .catch(error=>{
           console.log(e);
         })
  },
   pendingAll(order_id){
    axios.get('/pending/all/order/'+order_id)
         .then(resp=>{
            if(resp.data){
               this.$toasted.show(resp.data, {
              type: "success",
              position: "top-center",
              duration: 2000,
              });
            this.$router.push({name:"PendingOrder"})

            }
         })
         .catch(error=>{
           console.log(error);
         })
  },

  


 
   cancelAll(order_id){
    axios.get('/cancel/all/order/'+order_id)
         .then(resp=>{
            if(resp.data){
               this.$toasted.show(resp.data, {
              type: "success",
              position: "top-center",
              duration: 2000,
              });
            this.$router.push({name:"CancelOrder"})

            }
         })
         .catch(error=>{
           console.log(error);
         })
  },
  comment(order_id,order_index,comment){

    
    console.log(comment);
     let options ={};
     this.comments.forEach(element => {
            options[element.name] = element.name;
     });

       let sSelect=document.getElementsByClassName('swal2-select');
       Swal.fire({
            title:comment ? comment:'Select a comment',
            input: 'select',
            inputOptions: options,
            inputPlaceholder: 'Select or change a comment',
            showCancelButton: true,
        }).then((result)=>{
          if(result.value){
            axios.get('/api/order/comment',{
              params:{
                order_id,
                comment:result.value,
              }
            })
            .then(resp=>{
              console.log(resp);
            })
            .catch(e=>{
              console.log(e);
            })

          }else{
            console.log("Ok")
          }
        })
    },

   
    
  },

  watch: {
    status: function (value) {
      if (value == 1) {
        this.heading = "New Orders";
      } else if (value == 2) {
        this.heading = "Pending Orders";
      } else if (value == 3) {
        this.heading = "Approved Orders";
      } else if (value == 4) {
        this.heading = "Shipment Orders";
      } else if (value == 5) {
        this.heading = "Delivered Orders";
      } else if (value == 7) {
        this.heading = "Return Orders";
      } else if (value == 6) {
        this.heading = "Cancel Orders";
      } else {
        this.heading = "All Orders";
      }
    },

    start_date:function(value){
        if(value.length>1){
          this.ordersList();
        }
    },
    end_date:function(value){
      if(value.length>1){
          this.ordersList();
        }
    },
     bulkActionType:function(value){
      this.selectBulkAction();
    },
    courier_id:function(value){
      this.ordersList();
    }

  },

 
};
</script>

<style>
.orders-heading {
  text-align: center;
  text-transform: uppercase;
  border-bottom: 2px solid #000;
  margin-bottom: 10px;
}
</style>

<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <router-link :to="{ name: 'resellerAdd' }" class="btn btn-primary"
            ><i class="fa fa-plus"></i
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
                  <div class="row">
                    <div style="margin-left: 10px" class="col-md-2">
                      <select  @change="paidPaidPayment" v-model="item"
                        class="form-control"
                      >
                        <option selected value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                        <option value="50">50</option>
                      </select>
                    </div>
                    
                    <div class="col-lg-4"></div>
                    <div class="col-lg-3" style="display:flex;position:absolute;right:0;">
                      <button
                        class="btn btn-info btn-sm"
                        @click="resellerFilter"
                        style="margin-right:5px;"
                      >
                        Filter
                      </button>
                        
                    </div>
                    
                  </div>
                </div>

                <div class="box-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Invoie_no</th>
                        <th>Reseller</th>
                        <th>commission</th>
                        <th>Total amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="(paid_payment,
                        index) in paid_payment_list.data"
                        :key="index"
                      >
                        <td>
                            {{ index+1 }}
                        </td>
                        <td>
                          
                           <router-link
                             target="_blank"
                             :to="{ name: 'viewOrder', params: { id: paid_payment.order.id },
                            }"
                            >   {{ paid_payment.order.invoice_no }}

                           </router-link>
                          </td>
                        <td>{{ paid_payment.reseller.username }}</td>
                        <td>{{ paid_payment.total_amount }}</td>
                        <td>{{ paid_payment.total_percent }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="box-footer">
                  <div class="row">
                    <div class="col-md-6">
                      <pagination
                        :data="paid_payment_list"
                        :limit="3"
                        @pagination-change-page="paidPaidPayment"
                      >
                        <span slot="prev-nav">&lt; Previous</span>
                        <span slot="next-nav">Next &gt;</span>
                      </pagination>
                    </div>
                    <div
                      class="col-md-6"
                      style="margin-top: 25px; text-align: right"
                    >
                      <p>
                        showing
                        <strong>{{ paid_payment_list.from }} </strong> to
                        <strong>{{ paid_payment_list.to }} </strong> of
                        total entities {{ paid_payment_list.total }}
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
export default {
  mounted() {
   this.paidPaidPayment();
  },

  data() {
    return {
      paid_payment_list: {},
      loading: true,
      item: 10,
      reseller_id:'',
      id:[],
      action:'',
     };
  },

  methods: {
    paidPaidPayment(page = 1) {
      axios
        .get("/api/paid/payment?page=" + page, {
          params: {
               item: this.item,
               reseller_id:this.reseller_id
          }
        })
        .then((resp) => {
            if(resp.data.data.length>0){
                this.paid_payment_list=resp.data;
            }
            this.loading=false;
        })
      
    },
    resellerFilter(){
        this.$Progress.start();
        axios .get("/api/reseller/list",{
            params:{
                item:3000
            }
        })
        .then(resp=>{
           this.$Progress.finish();
                if(resp.data){
                let input_options={};
                resp.data.resellers.data.forEach(element => {
                    input_options[element.id]=element.username+'-'+element.name
                });
                Swal.fire({
                title:"Select Reseller",
                input: 'select',
                inputOptions: input_options,
                inputPlaceholder: 'Select Reseller',
                showCancelButton: true,
                }).then(result=>{
                    if(result.value){
                        this.reseller_id=result.value;
                        this.paidPaidPayment();
                    }else{
                        this.reseller_id="";
                    }
                })
            }
        })
    },
   
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
</style>

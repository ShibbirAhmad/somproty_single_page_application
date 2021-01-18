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
                      <select  @change="unpaidPaidPayment" v-model="item"
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
                         <select v-model="action" class="form-control" @change="selecAction">
                        <option selected value="">Select Action</option>
                            <option value="payment">Make Payment</option>
                        </select>
                    </div>
                    
                  </div>
                </div>

                <div class="box-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th><input type="checkbox" @click="selectAll"></th>
                        <th>Invoie_no</th>
                        <th>Reseller</th>
                        <th>commission</th>
                        <th>Total amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="(unpaid_payment,
                        index) in unpaid_payment_list.data"
                        :key="index"
                      >
                        <td>
                            <input type="checkbox" :id="'check_'+unpaid_payment.id" @click="selectId(unpaid_payment.id)">
                            {{ index+1 }}
                        </td>
                        <td>
                            <router-link
                             target="_blank"
                             :to="{ name: 'viewOrder', params: { id: unpaid_payment.order.id },
                            }"
                            >   {{ unpaid_payment.order.invoice_no }}
                            </router-link>
                          
                          </td>
                        <td>{{ unpaid_payment.reseller.username }}</td>
                        <td>{{ unpaid_payment.total_amount }}</td>
                        <td>{{ unpaid_payment.total_percent }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="box-footer">
                  <div class="row">
                    <div class="col-md-6">
                      <pagination
                        :data="unpaid_payment_list"
                        :limit="3"
                        @pagination-change-page="unpaidPaidPayment"
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
                        <strong>{{ unpaid_payment_list.from }} </strong> to
                        <strong>{{ unpaid_payment_list.from }} </strong> of
                        total entities {{ unpaid_payment_list.total }}
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
    console.log("mounted reseller");
   this.unpaidPaidPayment();
  },

  data() {
    return {
      unpaid_payment_list: {},
      loading: true,
      item: 10,
      reseller_id:'',
      id:[],
      action:'',
     };
  },

  methods: {
    unpaidPaidPayment(page = 1) {
      axios
        .get("/api/unpaid/payment?page=" + page, {
          params: {
               item: this.item,
               reseller_id:this.reseller_id
          }
        })
        .then((resp) => {
            if(resp.data.data.length>0){
                this.unpaid_payment_list=resp.data;
                  this.$toasted.show('Paid......', {
                      type: "info",
                      position: "top-center",
                      duration: 3000,
                  });
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
                        this.unpaidPaidPayment();
                    }else{
                        this.reseller_id="";
                    }
                })
            }
        })
    },
    selectId(id){

    
        let index=this.id.indexOf(id);
       if(index<0){
        this.id.push(id);
      }
        else{
          this.id.splice(index,1)
      }
      //console.log(this.id)
     },
     selectAll(){
        this.unpaid_payment_list.data.forEach(ele=>{
            this.selectId(ele.id);
            if(document.getElementById('check_'+ele.id).checked==false){
                document.getElementById('check_'+ele.id).checked=true;
            }else{
                document.getElementById('check_'+ele.id).checked=false;
            }
         })
     },
     selecAction(){
       if(this.action=="payment"){
          this.paidSelected();
       }
     },
     paidSelected(){

       if(this.id.length<=0){
           this.$toasted.show("please select at least on row", {
            type: "error",
            position: "top-center",
            duration: 4000,
          });
          this.action='';
        return;
       }
       axios.get('/api/reseller/to/paid',{
         params:{
           id:this.id,
           reseller_id:this.reseller_id
         }
       })
       .then(resp=>{
         console.log(resp)
        if(resp.data.status=="OK"){
          console.log('ok')
        }else{
           this.$toasted.show(resp.data, {
            type: "error",
            position: "top-center",
            duration: 4000,
          });
          this.action='';
        }
       })
       .catch(e=>{
         console.log(e);
       })
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
</style>

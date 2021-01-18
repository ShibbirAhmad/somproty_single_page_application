<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <router-link :to="{name:'ManagePurchaseFabrics'}" class="btn btn-primary">
            <i class="fa fa-arrow-right"></i>
          </router-link>
        </h1>
        <ol class="breadcrumb">
          <li>
            <a href="#">
              <i class="fa fa-dashboard"></i>Dashboard
            </a>
          </li>
          <li class="active">Purchase</li>
        </ol>
      </section>
      <section class="content">
        <div class="row justify-content-center">
          <div class="col-lg-10 col-lg-offset-1">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Add Purchase</h3>
              </div>
              <div class="box-body">
                <h1 v-if="loading">
                  <i class="fa fa-spin fa-spinner"></i>
                </h1>
            
               <div v-else>
                  <div class="alert-danger alert" v-if="error">{{error}}</div>
                <div class="row">
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label>Purchase_date</label>
                      <date-picker  autocomplete="off" v-model="purchase_date" :config="options"></date-picker>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label>Invoice_no</label>
                      <input
                        class="form-control"
                        v-model="invoice_no"
                        placeholder="invoice"
                        @keyup="validation"
                        autofocus
                      />
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label>Supplier</label>
                      <select
                        class="form-control"
                        @change="validation"
                        v-model="supplier_id"
                        name="supplier"
                      >
                        <option value>Select Supplier</option>
                        <option
                          v-for="(supplier) in suppliers"
                          :value="supplier.id"
                          :key="supplier.id"
                        >{{supplier.company_name}}</option>
                      </select>
                    </div>
                  </div>
                   <div class="col-lg-3">
                    <div class="form-group">
                      <label>Document/Memo</label>
                      <input class="form-control" type="file" @change="uploadImage" name="document">
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="form-group">
                      <label for="">Total Amount</label>
                      <input type="text" class="form-control" @keyup="dueAmount" v-model="total">
                    </div>
                  </div>
                   <div class="col-lg-3">
                    <div class="form-group">
                      <label for="">Paid</label>
                      <input type="text" class="form-control" @keyup="dueAmount" v-model="paid">
                    </div>
                  </div>
                   <div class="col-lg-3">
                    <div class="form-group">
                      <label for="">Due Amout</label>
                      <input type="text" class="form-control"  readonly v-model="due">
                    </div>
                  </div>
                 <div class="col-lg-3">
                   <div class="form-group">
                      <label for="">Paid By</label>
                        <select name="debit_from" class="form-control" v-model="paid_by">
                                      <option value="Cash">Cash</option>
                                      <option value="Bkash(personal)">Bkash(personal)</option>
                                      <option value="Bkash(merchant)">Bkash(merchant)</option>
                                      <option value="Bank(SIBL)">Bank(SIBL)</option>
                                       <option value="Bank(AIBL)">Bank(AIBL)</option>

                     </select>
                    </div>
                 </div>
                </div>
               </div>
               
              <br />
                <button :disabled="submitValidation" type="submit" @click="add()" class="btn btn-primary"
                >Submit</button>

               
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
import datePicker from "vue-bootstrap-datetimepicker";

Vue.component(HasError.name, HasError);

export default {
  name: "Add",
  created() {
    this.pDate();
    this.supplierList();
   
  },
  data() {
    return {
      purchase_date: "",
      error: "",
      loading: true,
      status:2,
      options: {
        format: "YYYY-MM-DD",
        useCurrent: false,
      },
      supplier_id: "",
      suppliers: "",
      invoice_no: "",
      submitValidation: true,
      total: 0,
      paid: 0,
      due: 0,
      paid_by:"Cash",
      memo:""
    };
  },

  methods: {
    add() {
      this.$Progress.start();
      axios
        .post("/add/purchase", {
          purchase_date: this.purchase_date,
          supplier_id: this.supplier_id,
          total: this.total,
          paid: this.paid,
          invoice_no: this.invoice_no,
          status:this.status,
          paid_by:this.paid_by,
          memo:this.memo
        })
        .then((resp) => {
          this.$Progress.finish();
        console.log(resp)
          if (resp.data.status == "SUCCESS") {
            console.log(resp);
            this.$router.push({ name: "purchase" });
            this.$toasted.show(resp.data.message, {
              type: "success",
              position: "top-center",
              duration: 4000,
            });
          } else {
            this.error = "dont saved data. please try again";
          }
        })
        .catch((error) => {
          this.$Progress.finish();
          console.log(error);
          this.error = "some thing want to wrong";
        });
    },
    supplierList() {
      axios
        .get("/others",{
          params:{
            type:2
          }
        })

        .then((resp) => {
          console.log(resp)
          if (resp.data.status == "SUCCESS") {
            this.suppliers = resp.data.suppliers;
            this.loading=false;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  
    dueAmount() {
        this.due=parseInt(this.total)-parseInt(this.paid);
        this.validation()
      
    },
     validation() {
      
      if (this.invoice_no.length > 0 && this.supplier_id && this.total>0 && this.memo.length > 0) {
        this.submitValidation = false;
      } else {
        this.submitValidation = true;
      }
      // this.submitValidation();
    },
     uploadImage(e) {
      var file = e.target.files[0];
    
    if (!file.type.match("image.*")) {
         Swal.fire({
          type:'warning',
          text:'this is not any kind of image',
        });
        this.memo="";
         this.validation();
        return;
      }

        let reader = new FileReader();
        reader.onload = (e) => {
        this.memo = e.target.result;
         this.validation();
        };
      reader.readAsDataURL(file);
     
    },

   
    pDate() {
      let d = new Date();

      let month = d.getMonth() + 1;
      let day = d.getDate();
      let output =
        d.getFullYear() +
        "-" +
        (("" + month).length < 2 ? "0" : "") +
        month +
        "-" +
        (("" + day).length < 2 ? "0" : "") +
        day;
      this.purchase_date = output;
    },
  },
  computed: {},
  components: {
    datePicker,
  },
};
//Date picker
</script>

<style scoped>
.mb-2 {
  margin-bottom: 5px !important;
}

.autocomplete {
  max-height: 120px;
  overflow-y: scroll;
  position: absolute;
  width: 100%;
  z-index: 454;
}

.autocomplete li:hover {
  background: #222d32;
  color: #ffffff;
}
</style>

<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <router-link :to="{ name: 'addOrder' }" class="btn btn-primary">
            <i class="fa fa-plus"></i>
          </router-link>
          <router-link :to="{ name: 'NewOrder' }" class="btn btn-sm btn-success"
            >New</router-link
          >
          <router-link
            :to="{ name: 'PendingOrder' }"
            class="btn btn-sm btn-success"
            >Pending</router-link
          >
          <router-link
            :to="{ name: 'ApprovedOrder' }"
            class="btn btn-sm btn-success"
            >Approved</router-link
          >
          <router-link
            :to="{ name: 'ShipmentOrder' }"
            class="btn btn-sm btn-success"
            >Shipment</router-link
          >
          <router-link
            :to="{ name: 'DeliveredOrder' }"
            class="btn btn-sm btn-success"
            >Delivered</router-link
          >
        </h1>
        <ol class="breadcrumb">
          <li>
            <a href="#"> <i class="fa fa-dashboard"></i>Dashboard </a>
          </li>
          <li class="active">Product Stock</li>
        </ol>
      </section>
      <section class="content">
        <div class="container">
          <div class="row">
            <div class="col-lg-11">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <div class="row">
                    <div class="col-lg-2">
                      <select
                        class="form-control"
                        v-model="item"
                        @change="productList()"
                      >
                        <option value="20">20</option>
                        <option value="40">40</option>
                        <option value="80">80</option>
                        <option value="150">150</option>
                        <option value="200">200</option>
                        <option value="500">500</option>
                      </select>
                    </div>
                    <div class="col-lg-2">
                      <!-- <button @click="downloadPDF" class="btn btn-info">
                        <i class="fa fa-download"></i>Download PDF
                      </button> -->
                    </div>

                    <div class="col-lg-4 orders-heading">
                      <h3 class="box-title">REPORT:STOCK</h3>
                    </div>
                    <div class="col-lg-4">
                      <input
                        class="form-control"
                        placeholder="search with product code || product name "
                        v-model="search"
                        @keyup="searchProducts()"
                      />
                    </div>
                  </div>
                </div>
                <div class="box-body">
                  <table class="table" id="myTable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product</th>
                        <th scope="col">Stock</th>
                        <th>Total Purchase quantity</th>
                        <th>Avarage purchase price</th>
                        <th>Total purchase Price</th>
                      <th>Cureent Stock Value</th>

                      </tr>
                    </thead>
                    <tbody>
                      <h1 class="text-center" v-if="loading">
                        <i class="fa fa-spin fa-spinner"></i>
                      </h1>
                      <tr v-for="(product, index) in products.data" :key="index">
                        <td scope="row">{{ index+1 }}</td>
                        <td>
                          <h4>
                            {{
                              product.name +
                              "-" +
                              product.product_code
                            }}
                          </h4>
                        </td>
                        <td>
                       {{ product.stock }}
                        </td>
                        <td>
                          {{ totalPurchaseQuanityt(product.purchase_item) }}
                        </td>
                        <td>
                          {{ avaragePrice(product.purchase_item) }}
                        </td>
                        <td>
                          {{ totalPrice(product.purchase_item) }}
                        </td>
                         <td>
                          {{ curentStockPrice(product.stock,product.purchase_item) }}
                        </td>
                        <td></td>
                  
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="box-footer">
                  <div class="row">
                    <div class="col-lg-6">
                      <pagination
                        :data="products"
                        @pagination-change-page="productList"
                        :limit="5"
                      ></pagination>
                    </div>
                    <div
                      class="col-lg-6 mt-1"
                      style="margin-top: 25px; text-align: right"
                    >
                    <csvExport table_id="myTable"></csvExport>
                      <p>
                        Showing
                        <strong>{{ products.from }}</strong> to
                        <strong>{{ products.to }}</strong> of total
                        <strong>{{ products.total }}</strong> entries
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
import { Form, HasError, AlertError } from "vform";
import csvExport from "../export/csv"

export default {
  created() {
   this.productList()

    //this.interval = setInterval(() => this.productList(), 3000 );
  },
  data() {
    return {
      products: {},
      loading: true,
      search: "",
      item: 10,
     
    };
  },
  methods: {
    productList(page=1) {
      console.log("resp");
      axios
        .get("/api/product/stock?page="+page, {
          params: {
            item: this.item,
          },
        })
        .then((resp) => {
          if(resp.data){
            this.products = resp.data;
             this.loading = false;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    searchProducts(){
     if(this.search.length>1){
        axios.get('/api/search/seggested/product/with/name/code/'+this.search)
      .then(resp=>{
        console.log(resp)
         if(resp.data){
           console.log(resp.data)
            this.products = resp.data;
          }else{
            this.productList()
          }
      })
     
     }else{
       this.productList();
       
     }
    },

    downloadPDF() {
      window.open("/api/get/stock/product/pdf", "_blank");
    },
    totalPurchaseQuanityt(items){
      let total=0;
      items.forEach(element => {
        total+=parseInt(element.stock);
      });

      return total;
    },
    avaragePrice(items){
      let total=0;
      let total_stock=0;
      items.forEach(element => {
        total +=parseInt(element.price)*parseInt(element.stock);
        total_stock+=parseInt(element.stock);
      });

let a_price=parseFloat(total)/parseFloat(total_stock);
      return a_price.toFixed(2);
    },
    totalPrice(items){
      let total=0;
      items.forEach(element => {
        total +=parseInt(element.price)*parseInt(element.stock);
      });

      return parseFloat(total);
    },
    curentStockPrice(stock,items){
        let total=0;
        let total_stock=0;
        items.forEach(element => {
        total +=parseInt(element.price)*parseInt(element.stock);
        total_stock+=parseInt(element.stock);
       });
       let a_price=total/total_stock;

       return `${stock}*${a_price.toFixed(2)}=${parseFloat(stock)*parseFloat(a_price.toFixed(2))}`
    }
    
  },

  computed: {},

  components:{
    csvExport
  }
};
</script>

<style scoped>
</style>

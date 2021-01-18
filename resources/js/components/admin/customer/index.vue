<template>
  <div>
    <admin-main> </admin-main>
    <div class="content-wrapper">
      <section style="margin-bottom: 20px" class="content-header">
        <h1>

        </h1>
        <ol class="breadcrumb">
          <li>
            <a href="#"><i class="fa fa-dashboard"></i>Dashboard</a>
          </li>
          <li class="active">Customer</li>
        </ol>
      </section>
      <section class="content">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-10 col-lg-10 offset-1">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Customer table</h3>
                       <div style="margin-bottom: 5px; margin-top: 10px" class="row">
                 
                    <div class="col-md-3">
                      <select
                        v-model="customer_type"
                        class="form-control "
                        @change="exportData"
                      >
                        <option disabled value="">Select export customer </option>
                        <option value="all"> all customers</option>
                      </select> 
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                      <input
                        type="text"
                        @keyup="searchData"
                        v-model="search"
                        class="form-control"
                        placeholder="customer name or 01xxxxxxxxx"
                        id=""
                      />
                    </div>
                    <div style="margin-left: -23px" class="col-md-1">
                      <button class="btn btn-success" type="submit">
                        search
                      </button>
                    </div>
            
                </div>
                </div>
           
                <div class="box-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">City</th>
                        <th scope="col">Address</th>
                      </tr>
                    </thead>
                    <tbody>
                      <h1 class="text-center" v-if="loading">
                        <i class="fa fa-spin fa-spinner"></i>
                      </h1>
                      <tr
                        v-for="(customer, index) in customers.data"
                        v-bind:key="index"
                      >
                        <td scope="row">{{ index + 1 }}</td>
                        <td>{{ customer.name }}</td>
                        <td>{{ customer.phone }}</td>
                        <td>
                          {{
                            customer.customer_city
                              ? customer.customer_city.name
                              : "null"
                          }}
                        </td>
                        <td>{{ customer.address }}</td>
                      </tr>
                    </tbody>
                    <!--                                        <pagination :data="customers" @pagination-change-page="getResults"></pagination>-->
                  </table>
                </div>
                <div class="box-footer">
                  <div class="row">
                    <div class="col-lg-4">
                      <pagination
                        :data="customers"
                        :limit="3"
                        @pagination-change-page="customerList"
                      >
                      </pagination>
                    </div>
                    <div
                      class="col-lg-6 mt-1"
                      style="margin-top: 25px; text-align: right"
                    >
                      <p>
                        Showing <strong>{{ customers.from }}</strong> to
                        <strong>{{ customers.to }}</strong> of total
                        <strong>{{ customers.total }}</strong> entries
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
  created() {
    setTimeout(() => {
      this.customerList();
    }, 500);
  },
  data() {
    return {
      customers: {},
      loading: true,
      search: "",
      customer_type:"",
    };
  },
  methods: {
    customerList(page = 1) {
      axios
        .get("/list/customer?page=" + page)
        .then((resp) => {
          if (resp.data.status == "SUCCESS") {
            this.customers = resp.data.customers;
            this.loading = false;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    searchData() {
      if (this.search.length >= 3) {
        axios.get("/search/customer/" + this.search).then((resp) => {
          if (resp.data.success == "OK") {
            this.customers = resp.data.customers;
            console.log(resp);
          }
        });
      }else{
          this.customerList()
      }
    },
    exportData(){

        if (this.customer_type=="all") {
          
                   window.open('/api/export/customers','_blank');
            
        }else {
           Swal.fire({
              title:' sorry :) something went wrong' ,
              icon : 'error',

           });
        }
    },
  
  
   
      
    
    
  },
};
</script>

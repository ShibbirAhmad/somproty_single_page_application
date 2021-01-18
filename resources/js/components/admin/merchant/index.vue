<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <router-link :to="{ name: 'add_merchant' }" class="btn btn-primary"
            ><i class="fa fa-plus"></i
          ></router-link>
          <button @click="exportMerchant" class="btn  btn-success"> <i class="fa fa-download"></i> Export Merchant </button>
        </h1>
        <ol class="breadcrumb">
          <li>
            <a href="#"><i class="fa fa-dashboard"></i>Dashboard</a>
          </li>
          <li class="active">merchant</li>
        </ol>
      </section>

      <section class="content">
        <div class="container">
          <div class="row">
            <div class="col-lg-11">
              <div class="box box-primary">
                <div class="box-header with-border"></div>
                <div class="row">
                  <div style="margin-left: 10px" class="col-md-2">
                    <select
                      @change="getmerchantList"
                      v-model="item"
                      class="form-control"
                      id=""
                    >
                      <option selected value="10">10</option>
                      <option value="20">20</option>
                      <option value="30">30</option>
                      <option value="40">40</option>
                      <option value="50">50</option>
                    </select>
                  </div>

                    <div class="col-md-5"></div>
                   <div class="col-md-4">
                    <input type="text" placeholder="company_name email or phone " @keyup="searchMerchant" v-model="search" class="form-control " > 
                         
                   </div>
                     <button style="margin-left:-12px;" class="btn btn-primary" type="submit">search</button>
                </div>
                <div class="box-body">
                  <table class="table text-center">
                    <thead>
                      <tr>
                        <th scope="col">Serial</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">phone</th>
                        <th scope="col">Company Name</th>
                        <th scope="col">Image</th>
                        <th scope="col">Address</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <h1 class="text-center" v-if="loading">
                        <i class="fa fa-spin fa-spinner"></i>
                      </h1>
                      <tr
                        v-for="(merchant, index) in merchantList.data"
                        :key="index"
                      >
                        <td>{{ index }}</td>
                        <td> <a  @click.prevent="merchantDashboard(merchant.id,index)" href="#">{{ merchant.name }} </a> </td>
                        <td>{{ merchant.email }}</td>
                        <td>{{ merchant.phone }}</td>
                        <td>{{ merchant.company_name }}</td>
                        <td>
                          <img v-if="merchant.image" :src="basePath + merchant.image" class="img-circle small-image"/>
                           <img  v-else  :src="basePath+'images/static/noimage.png'" class="img-circle small-image"/>
                        </td>
                        <td>{{ merchant.address }}</td>
                        <td>
                          <span
                            v-if="merchant.status == 1"
                            class="badge btn-success">Active</span >
                          <span v-else class="badge btn-warning">De-Active</span>
                        </td>
                        <td>
                          <router-link
                            :to="{
                              name: 'edit_merchant',
                              params: { id: merchant.id },
                            }"
                            class="btn btn-sm btn-success"
                          >
                            <i class="fa fa-edit"></i>
                          </router-link>

                          <button
                            v-if="merchant.status == 1"
                            class="btn btn-sm btn-warning"
                          >
                            <i class="fa fa-ban" @click="deActive(merchant)">
                            </i>
                          </button>
                          <button v-else class="btn btn-sm btn-success">
                            <i class="fa fa-check" @click="active(merchant)">
                            </i>
                          </button>

                          <a class="btn btn-sm btn-danger">
                            <i
                              @click="trash_merchant(merchant.id, index)"
                              class="fa fa-trash"
                            ></i>
                          </a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="row">
                    <div class="col-md-6">
                      <pagination
                        :data="merchantList"
                        :limit="3"
                        @pagination-change-page="getmerchantList"
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
                        showing <strong>{{ merchantList.from }} </strong> to
                        <strong>{{ merchantList.from }} </strong> of total
                        entities {{ merchantList.total }}
                      </p>
                    </div>
                  </div>
                </div>
                <div class="box-footer"></div>
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
    console.log("mounted merchant");
    setTimeout(() => {
      this.loading = false;
    }, 500);
    this.getmerchantList();
  },

  data() {
    return {
      merchantList: {},
      loading: true,
      item: 10,
      basePath: this.$store.getters.image_base_link,
      search : '',
    };
  },

  methods: {

        searchMerchant(page=1){
       axios.get('/api/search/merchant/'+this.search+'?page='+page)
       .then(resp => {
         console.log(resp);
         if (resp.data.status == "OK") {
             this.merchantList = resp.data.merchants ;
         }else{
           this.getmerchantList() ;
         }
       })
       .catch()
     }, 

    deActive(merchant) {
      Swal.fire({
        title: "Are you sure?",
        text: "Do you want de-active this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes!",
      }).then((result) => {
        if (result.value) {
          axios
            .get("/api/merchant/deactive/" + merchant.id)
            .then((resp) => {
              if (resp.data.success == "OK") {
                this.getmerchantList();
                this.$toasted.show(resp.data.message, {
                  position: "top-center",
                  type: "success",
                  duration: 4000,
                });
              } else {
                this.$toasted.show("some thing want to wrong", {
                  position: "top-center",
                  type: "error",
                  duration: 4000,
                });
              }
            })
            .catch((error) => {
              this.$toasted.show("some thing want to wrong", {
                position: "top-center",
                type: "error",
                duration: 4000,
              });
            });
        } else {
          this.$toasted.show("OK ! no action here", {
            position: "top-center",
            type: "info",
            duration: 3000,
          });
        }
      });
    },
    active(merchant) {
      Swal.fire({
        title: "Are you sure?",
        text: "Do you want active this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes!",
      }).then((result) => {
        if (result.value) {
          axios
            .get("/api/merchant/active/" + merchant.id)
            .then((resp) => {
              if (resp.data.success == "OK") {
                this.getmerchantList();
                this.$toasted.show(resp.data.message, {
                  position: "top-center",
                  type: "success",
                  duration: 4000,
                });
              } else {
                this.$toasted.show("some thing want to wrong", {
                  position: "top-center",
                  type: "error",
                  duration: 4000,
                });
              }
            })
            .catch((error) => {
              this.$toasted.show("some thing want to wrong", {
                position: "top-center",
                type: "error",
                duration: 4000,
              });
            });
        } else {
          this.$toasted.show("Ok ! no action here", {
            position: "top-center",
            type: "info",
            duration: 3000,
          });
        }
      });
    },

    getmerchantList(page = 1) {
      axios
        .get("/api/merchant/list?page=" + page, {
          params: { item: this.item },
        })
        .then((resp) => {
          console.log(resp);
          if (resp.data.success == "OK") {
            this.merchantList = resp.data.merchants;
          }
        })
        .catch();
    },

    trash_merchant(merchant_id, index) {
      if (confirm("Are you sure to remove")) {
        axios
          .get("/api/merchant/trash/" + merchant_id)
          .then((resp) => {
            console.log(resp);
            if (resp.data.success == "OK") {
              alert(resp.data.message);
              this.merchantList.data.splice(index, 1);
            }
          })
          .catch();
      }
    },
    merchantDashboard(merchant_id,index){
      axios.get('/api/admin/to/merchant/'+merchant_id)
      .then(resp=>{
        if(resp.data.status=="OK"){
         localStorage.setItem("merchant_token", resp.data.token);
            this.$store.commit("merchant", resp.data.merchant);
            window.open('/merchant/backend/home','_blank');
           // this.$router.push({ name: "merchant_dashboard" });
           // location.reload();
        }
      })
    },
    exportMerchant(){
       window.open('/api/export/merchants','_blank');
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

<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <router-link :to="{ name: 'add_selling_offer' }" class="btn btn-primary"
            ><i class="fa fa-plus"></i
          ></router-link>
        </h1>
        <ol class="breadcrumb">
          <li>
            <a href="#"><i class="fa fa-dashboard"></i>Dashboard</a>
          </li>
          <li class="active">Selling Offer </li>
        </ol>
      </section>
      <section class="content">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-10">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <div class="row">
                    <div class="col-lg-6">
                      <h3 class="box-title">Office_sale</h3>
                    </div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-2">
                     
                    </div>
                  </div>
                </div>
                <div class="box-body">
                  <table class="table table-responsive text-center ">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Order By</th>
                        <th scope="col">Status</th>
                        <th scope="col">Expire Date</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <h1 v-if="loading">
                        <i class="fa fa-spin fa-spinner"></i>
                      </h1>
                      <tr v-for="(offer,index) in sellingOffer.data " :key="index" >
                          <td>{{ index  }}</td>
                          <td>{{ offer.name   }}</td>
                          <td>{{ offer.order_by   }}</td>
                          <td>
                              <span v-if="offer.status==1" class="bage btn-success">Active</span>
                              <span v-else class="bage btn-warning">De-Active</span>
                          </td>
                          <td>{{ offer.expire_date  }}</td>
                          <td>
                          <router-link :to="{name :'edit_selling_offer', params:{id : offer.id} }"  class="btn btn-success" > <i class="fa fa-edit"></i> </router-link>
                         
                          <button v-if="offer.status==0" class="btn btn-warning " @click="active(offer)" > <i class="fa fa-check"></i> </button>
                          <button  v-else class="btn btn-warning " @click="deActive(offer)" > <i class="fa fa-ban"></i> </button>
                          
                          </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="box-footer">
                  <div class="row">
                    <div class="col-lg-6">
                    <pagination :data="sellingOffer" @pagination-change-page="this.sellingOfferList" > </pagination>
                    </div>
                    <div
                      class="col-lg-6 mt-1"
                      style="margin-top: 25px; text-align: right"
                    >
                      <p>
                        Showing <strong>{{ sellingOffer.from }}</strong> to
                        <strong>{{ sellingOffer.to }}</strong> of total
                        <strong>{{ sellingOffer.total }}</strong> entries
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

     mounted(){
         setTimeout( ()=>{
             this.loading=false ;
         },500) ;
          this.sellingOfferList();
     },

     data(){
         
       return {

         sellingOffer : {},
         name : '',
         loading : true,

         }
     },

     methods : {

          sellingOfferList(page = 1){
              axios.get('/selling/offer/list?page=' + page)
              .then(resp => {
                  console.log(resp);
                  if (resp.data.success == "OK") {
                      this.sellingOffer = resp.data.sellingOffer ;
                  }
              })
              .catch()
          },

                   deActive(offer) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want de-active this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!'
                }).then((result) => {
                    if (result.value) {

                        axios.get('/selling/offer/deactive/' + offer.id)
                            .then((resp) => {
                                if (resp.data.success == 'OK') {
                                    this.sellingOfferList();
                                    this.$toasted.show(resp.data.message, {
                                        position: 'top-center',
                                        type: 'success',
                                        duration: 4000
                                    });
                                } else {
                                    this.$toasted.show('some thing want to wrong', {
                                        position: 'top-center',
                                        type: 'error',
                                        duration: 4000
                                    });
                                }

                            })
                            .catch((error) => {
                                this.$toasted.show('some thing want to wrong', {
                                    position: 'top-center',
                                    type: 'error',
                                    duration: 4000
                                });
                            })


                    } else {
                        this.$toasted.show('OK ! no action here', {
                            position: 'top-center',
                            type: 'info',
                            duration: 3000
                        });
                    }
                })
            },
            active(offer) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want active this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!'
                }).then((result) => {
                    if (result.value) {

                        axios.get('/selling/offer/active/' + offer.id)
                            .then((resp) => {
                                if (resp.data.success == 'OK') {
                                    this.sellingOfferList();
                                    this.$toasted.show(resp.data.message, {
                                        position: 'top-center',
                                        type: 'success',
                                        duration: 4000
                                    });
                                } else {
                                    this.$toasted.show('some thing want to wrong', {
                                        position: 'top-center',
                                        type: 'error',
                                        duration: 4000
                                    });
                                }

                            })
                            .catch((error) => {
                                this.$toasted.show('some thing want to wrong', {
                                    position: 'top-center',
                                    type: 'error',
                                    duration: 4000
                                });
                            })


                    } else {
                        this.$toasted.show('Ok ! no action here', {
                            position: 'top-center',
                            type: 'info',
                            duration: 3000
                        });
                    }
                })
            },









     },
}
</script>


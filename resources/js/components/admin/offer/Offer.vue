<template>
    <div>
        <admin-main></admin-main>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <router-link :to="{name:'offerAdd'}" class="btn btn-primary"><i class="fa fa-plus"></i></router-link>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                    <li class="active">Offer</li>
                </ol>
            </section>
            <section class="content">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-lg-offset-1">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Offer  table</h3>
                                </div>
                                <div class="box-body">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Image </th>
                                            <th scope="col">Url</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <h1 class="text-center" v-if="loading"><i class="fa fa-spin fa-spinner"></i>
                                        </h1>
                                        <tr v-else v-for="(offer,index) in offers.data">
                                            <td scope="row">{{index+1}}</td>

                                            <td>
                                                <img :src="basePath+offer.image"
                                                     style="width: 100px;" alt="User Image">
                                            </td>

                                            <td>
                                             {{offer.url}}
                                            </td>
                                            <td>
                                                <span v-if="offer.status==1" class="badge">Active</span>
                                                <span v-else class="badge badge-danger">De-active</span>
                                            </td>
                                            <td>
                                                <router-link  class="btn btn-sm btn-success" :to="{ name: 'edit_offer', params:{ id: offer.id } }"> <i class="fa fa-edit"></i> </router-link>
                                                <a class="btn btn-danger btn-sm" @click="remove(offer)"><i class="fa fa-trash"></i></a>

                                                <a class="btn btn-sm btn-warning" title="De-active" @click="deActive(offer)"
                                                   v-if="offer.status==1"><i class="fa fa-ban"></i></a>
                                                <a class="btn btn-sm btn-primary" title="active" @click="active(offer)"
                                                   v-else><i
                                                    class="fa fa-check"></i></a>
                                            </td>
                                        </tr>
                                        </tbody>

                                    </table>

                                </div>
                                <div class="box-footer">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <pagination :data="offers"
                                                        @pagination-change-page="getPagination">

                                            </pagination>

                                        </div>
                                        <div class="col-lg-6 mt-1" style="margin-top: 25px;text-align:right;">
                                            <p>Showing <strong>{{offers.from}}</strong> to
                                                <strong>{{offers.to}}</strong> of total
                                                <strong>{{offers.total}}</strong> entries
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
                this.offerList();
            }, 500);
            // this.getResults();

        },
        data() {
            return {
                offers: {},
                loading: true,
                basePath: this.$store.state.image_base_link
            }
        },
        methods: {
            offerList() {
                axios.get('/list/offer')
                    .then((resp) => {

                        if (resp.data.status == 'SUCCESS') {
                            this.offers = resp.data.offers;
                            this.loading = false

                        }
                    })
                    .catch((error) => {
                        console.log(error);
                    })
            },
            deActive(offer) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't de-active this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!'
                }).then((result) => {
                    if (result.value) {

                        axios.get('/deActive/offer/' + offer.id)
                            .then((resp) => {
                                //  console.log(resp)
                                if (resp.data.status == 'SUCCESS') {
                                    this.offerList();
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
                                // console.log(error)
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
                    text: "You won't active this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!'
                }).then((result) => {
                    if (result.value) {

                        axios.get('/active/offer/' + offer.id)
                            .then((resp) => {
                                if (resp.data.status == 'SUCCESS') {
                                    this.offerList();
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
            remove(offer) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't delete this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!'
                }).then((result) => {
                    if (result.value) {

                        axios.get('/delete/offer/' + offer.id)
                            .then((resp) => {
                                console.log(resp)
                                if (resp.data.status == 'SUCCESS') {
                                    this.offerList();
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
            getPagination(page = 1) {
                this.loading = true;
                axios.get('/list/offer?page=' + page)
                    .then(response => {
                        this.loading = false;
                        this.offers = response.data.offers;
                    });
            }

        },
        computed: {}
    }

</script>

<style scoped>

</style>

<template>
    <div>
        <admin-main></admin-main>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <router-link :to="{name:'variantAdd'}" class="btn btn-primary"><i class="fa fa-plus"></i></router-link>
                    <router-link :to="{name:'attribute'}" class="btn btn-success">Attribute</router-link>

                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                    <li class="active">Attribute</li>
                </ol>
            </section>
            <section class="content">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-lg-offset-1">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h3 class="box-title">Variant table</h3>

                                        </div>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">name</th>
                                            <th scope="col">attribute</th>
                                            <th scope="col">status</th>
                                            <th scope="col">action</th>


                                        </tr>
                                        </thead>
                                        <tbody>
                                        <h1 v-if="loading"><i class="fa fa-spin fa-spinner"></i></h1>
                                        <tr v-for="(variant,index) in variants" v-else>
                                            <td scope="row">{{index+1}}</td>
                                            <td>{{variant.name}}</td>
                                            <td>{{variant.attribute.name}}</td>
                                            <td>
                                                <span v-if="variant.status==1" class="badge">Active</span>
                                                <span v-else class="badge">De-active</span>
                                            </td>
                                            <td>

                                                <a class="btn btn-warning" title="De-active"
                                                   @click="deActive(variant)"
                                                   v-if="variant.status==1"><i class="fa fa-ban"></i></a>
                                                <a class="btn btn-primary" title="active" @click="active(variant)"
                                                   v-else><i
                                                    class="fa fa-check"></i></a>

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
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

    export default {
        components: {Index},
        created() {

            setTimeout(() => {
                this.variant();
            }, 500)
        },
        data() {
            return {
                variants: {},
                loading: true,
                search: '',
                basePath: 'storage/'
            }
        },
        methods: {

            variant() {
                axios.get('/list/variant')
                    .then((resp) => {
                        //  console.log(resp)
                        if (resp.data.status == 'SUCCESS') {
                            this.variants = resp.data.variants;
                            this.loading = false
                        } else {
                            this.$toasted.show('some thing want to wrong', {
                                type: "error",
                                position: 'top-center',
                                duration: 5000
                            });
                        }
                    })
                    .catch((error) => {
                        // console.log(error)
                        this.$toasted.show('some thing want to wrong', {
                            type: "error",
                            position: 'top-center',
                            duration: 4000
                        });
                    })
            },

            active(variant) {
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

                        axios.get('/active/variant/' + variant.id)
                            .then((resp) => {
                                if (resp.data.status == 'SUCCESS') {
                                    this.variant();
                                    this.$toasted.show(resp.data.message, {
                                        position: 'top-center',
                                        type: 'success',
                                        duration: 4000
                                    });
                                } else {
                                    this.$toasted.show('some thing want to wrong', {
                                        position: 'top-center',
                                        type: 'error',
                                        duration: 3000
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
            deActive(variant) {
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

                        axios.get('/deActive/variant/' + variant.id)
                            .then((resp) => {
                                if (resp.data.status == 'SUCCESS') {
                                    this.variant();
                                    this.$toasted.show(resp.data.message, {
                                        position: 'top-center',
                                        type: 'success',
                                        duration: 3000
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
                                    duration: 3000
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

        }
    }

</script>

<style scoped>

</style>

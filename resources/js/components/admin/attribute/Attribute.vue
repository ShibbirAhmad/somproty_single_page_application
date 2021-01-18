<template>
    <div>
        <admin-main></admin-main>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <router-link :to="{name:'attributeAdd'}" class="btn btn-primary"><i class="fa fa-plus"></i></router-link>
                    <router-link :to="{name:'variant'}" class="btn btn-success">Variant</router-link>

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
                                            <h3 class="box-title">Attribute table</h3>

                                        </div>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">name</th>
                                            <th scope="col">status</th>
                                            <th scope="col">action</th>


                                        </tr>
                                        </thead>
                                        <tbody>
                                        <h1 v-if="loading"><i class="fa fa-spin fa-spinner"></i></h1>
                                        <tr v-for="(attribute,index) in attributes" v-else>
                                            <td scope="row">{{index+1}}</td>
                                            <td>{{attribute.name}}</td>
                                            <td>
                                                <span v-if="attribute.status==1" class="badge">Active</span>
                                                <span v-else class="badge">De-active</span>
                                            </td>
                                            <td>
                                                <a class="btn btn-warning" title="De-active"
                                                   @click="deActive(attribute)"
                                                   v-if="attribute.status==1"><i class="fa fa-ban"></i></a>
                                                <a class="btn btn-primary" title="active" @click="active(attribute)"
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
                this.attribute();
            }, 500)
        },
        data() {
            return {
                attributes: {},
                loading: true,
                search: '',
                basePath: 'storage/'
            }
        },
        methods: {

            attribute() {
                axios.get('/list/attribute')
                    .then((resp) => {
                        if (resp.data.status == 'SUCCESS') {
                            this.attributes = resp.data.attributes;
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
                        this.$toasted.show('some thing want to wrong', {
                            type: "error",
                            position: 'top-center',
                            duration: 4000
                        });
                    })
            },

            active(attribute) {
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

                        axios.get('/active/attribute/' + attribute.id)
                            .then((resp) => {
                                if (resp.data.status == 'SUCCESS') {
                                    this.attribute();
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
            deActive(attribute) {
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

                        axios.get('/deActive/attribute/' + attribute.id)
                            .then((resp) => {
                                if (resp.data.status == 'SUCCESS') {
                                    this.attribute();
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


        }
    }

</script>

<style scoped>

</style>

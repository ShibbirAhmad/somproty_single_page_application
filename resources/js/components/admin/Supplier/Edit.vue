<template>
    <div>
        <admin-main></admin-main>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <router-link :to="{name:'supplier'}" class="btn btn-primary"><i class="fa fa-arrow-right"></i></router-link>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                    <li class="active">Edit Supplier</li>
                </ol>
            </section>
            <section class="content">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-lg-offset-2">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Edit Supplier</h3>
                            </div>
                            <div class="box-body">
                                <h1 v-if="loading"><i class="fa fa-spinner fa-spin"></i></h1>
                                <form v-else @submit.prevent="update" @keydown="form.onKeydown($event)"
                                      enctype="multipart/form-data">

                                    <div class="alert-danger alert" v-if="error">
                                        {{error}}
                                    </div>
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input v-model="form.name" type="text" name="name"
                                               class="form-control" :class="{ 'is-invalid': form.errors.has('name') }"
                                               autofocus autocomplete="off" placeholder="name">
                                        <has-error :form="form" field="name"></has-error>

                                    </div>
                                    <div class="form-group">
                                        <label>Company_name</label>
                                        <input v-model="form.company_name" type="text" name="company_name"
                                               class="form-control"
                                               :class="{ 'is-invalid': form.errors.has('company_name') }"
                                               autocomplete="off" placeholder="company_name">
                                        <has-error :form="form" field="company_name"></has-error>

                                    </div>
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input v-model="form.phone" type="text" minlength="11" maxlength="11"
                                               name="phone"
                                               class="form-control"
                                               :class="{ 'is-invalid': form.errors.has('phone') }"
                                               autofocus autocomplete="off" placeholder="phone">
                                        <has-error :form="form" field="phone"></has-error>

                                    </div>
                                    <div class="form-group">
                                        <label>address</label>
                                        <input class="form-control" v-model="form.address"
                                               :class="{ 'is-invalid': form.errors.has('address') }"
                                               type="text" placeholder="address" name="address" autocomplete="off">
                                        <has-error :form="form" field="address"></has-error>
                                    </div>
                                    <br/>
                                    <button :disabled="form.busy" type="submit" class="btn btn-primary"><i
                                        class="fa fa-spin fa-spinner" v-if="form.busy"></i>Submit
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </section>
        </div>
    </div>

</template>


<script>
    import Vue from 'vue'
    import {Form, HasError} from 'vform'

    Vue.component(HasError.name, HasError)

    export default {
        name: "Edit",
        created() {
            this.getSupplier();
           
        },
        data() {
            return {
                form: new Form({
                    name: "",
                    company_name: '',
                    address: '',
                    phone: "",

                }),
                loading: true,
                error: '',


            }
        },

        methods: {

            getSupplier() {
                axios.get('/edit/supplier/' + this.$route.params.id)
                    .then((resp) => {

                        if (resp.data.status == 'SUCCESS') {
                            this.form.name = resp.data.merchant.name;
                            this.form.phone = resp.data.merchant.phone;
                            this.form.address = resp.data.merchant.address;
                            this.form.company_name = resp.data.merchant.company_name;
                            this.loading=false;

                        } else {
                            this.$toasted.show('some thing want to wrong', {
                                type: "error",
                                position: "top-center",
                                duration: 5000
                            });
                        }

                    })
                    .catch((error) => {
                        console.log(error)
                        this.$toasted.show('some thing want to wrong', {
                            type: "error",
                            position: "top-center",
                            duration: 5000
                        });
                    })
            },
            update() {

                this.form.post('/update/supplier/' + this.$route.params.id, {
                    transformRequest: [function (data, headers) {
                        return objectToFormData(data)
                    }],
                    onUploadProgress: e => {
                        // Do whatever you want with the progress event
                        console.log(e)
                    }
                })
                    .then((resp) => {

                        if (resp.data.status == 'SUCCESS') {
                            this.$router.push({name: 'supplier'});
                            this.$toasted.show(resp.data.message, {
                                type: "success",
                                position: 'top-center',
                                duration: 4000
                            });
                        } else {
                            this.error = 'some thing want to wrong';
                        }

                    })
                    .catch((error) => {
                        this.error = 'some thing want to wrong';
                    })
            },

        },
        computed: {}
    }
</script>



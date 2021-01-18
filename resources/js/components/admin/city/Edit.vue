<template>
    <div>
        <admin-main></admin-main>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <router-link :to="{name:'city'}" class="btn btn-primary"><i class="fa fa-arrow-left"></i></router-link>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                    <li class="active"> City</li>
                </ol>
            </section>
            <section class="content">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-lg-offset-2">
                        <div class="box box-primary">
                            <div class="box-header with-border text-center">
                                <h3 class="box-title">Edit City Name</h3>
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
                                               autofocus autocomplete="off" placeholder="Ex:Dhaka">
                                        <has-error :form="form" field="name"></has-error>

                                    </div>
                                    <div class="form-group">
                                        <label>Delivery Charge(&#x9f3;)</label>
                                        <input v-model="form.delivery_charge" type="number" name="delivery_charge"
                                               class="form-control"
                                               :class="{ 'is-invalid': form.errors.has('delivery_charge') }"
                                               autocomplete="off"
                                               placeholder="Ex:90">
                                        <has-error :form="form" field="delivery_charge"></has-error>

                                    </div>
                                    <br/>
                                    <div class="form-group text-center">
                                        <button :disabled="form.busy" type="submit" class="btn btn-primary"><i
                                        class="fa fa-spin fa-spinner" v-if="form.busy"></i>Save
                                    </button>
                                    </div>
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
        name: "Add",
        created() {
            this.getCity();
            setTimeout(() => {
                this.loading = false
            }, 500)
        },
        data() {
            return {
                form: new Form({
                    name: "",
                    delivery_charge: '',

                }),
                loading: true,
                error: '',


            }
        },

        methods: {

            getCity() {
                axios.get('/edit/city/' + this.$route.params.id)
                    .then((resp) => {
                      //  console.log(resp)
                        if (resp.data.status == 'SUCCESS') {
                            this.form.name = resp.data.city.name;
                            this.form.delivery_charge = resp.data.city.delivery_charge;
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

                this.form.post('/update/city/' + this.$route.params.id, {
                    transformRequest: [function (data, headers) {
                        return objectToFormData(data)
                    }],
                    onUploadProgress: e => {
                        // Do whatever you want with the progress event
                        console.log(e)
                    }
                })
                    .then((resp) => {
                        console.log(resp)
                        if (resp.data.status == 'SUCCESS') {
                            this.$router.push({name: 'city'});
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
                        console.log(error)
                        this.error = 'some thing want to wrong';
                    })
            },

        },
        computed: {}
    }
</script>



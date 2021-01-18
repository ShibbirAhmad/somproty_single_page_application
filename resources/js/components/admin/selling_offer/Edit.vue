<template>
    <div>
        <admin-main></admin-main>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <router-link :to="{name:'selling_offer'}" class="btn btn-primary"><i class="fa fa-arrow-right"></i></router-link>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                    <li class="active">Selling Offer Update</li>
                </ol>
            </section>
            <section class="content">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-lg-offset-2">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Edit Selling Offer </h3>
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
                                        <label>Expire Date </label>
                                         <date-picker autocomplete="off" v-model="form.expire_date" :config="options" > </date-picker>

                                    </div>

                                    <div class="form-group">
                                        <label for="order_by">Display Order By</label>
                                        <select v-model="form.order_by" class="form-control" id="">
                                            <option selected > select order by</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
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
    import {Form, HasError, AlertError} from 'vform' ;
   
    import datePicker from 'vue-bootstrap-datetimepicker';

    Vue.component(HasError.name, HasError)
     export default {
      
        created() {
            setTimeout(() => {
                this.loading = false
            }, 500)

            this.getSellingOffer();
        },
        data() {
            return {
                form: new Form({
                    name: "",
                    expire_date: '',
                    order_by:'',
                }),
                options :{
                    format:"DD-MM-YYYY",
                    useCurrent: false ,
                },

                loading: true,
                error: ''
            }
        },

        methods: {

            update() {
                this.form.post('/selling/offer/edit/'+this.$route.params.id, {
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
                        if (resp.data.success == 'OK') {
                            this.$router.push({name: 'selling_offer'});
                            this.$toasted.show(resp.data.message, {
                                type: "success",
                                position: 'top-right',
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

            getSellingOffer(){
                axios.get('/selling/offer/get/'+this.$route.params.id)
                .then(resp => {
                    console.log(resp);
                    this.form.name= resp.data.offer.name ;
                    this.form.expire_date= resp.data.offer.expire_date ;
                })
            },

        },
        computed: {}
    }
</script>

<style scoped>
    .mb-2 {
        margin-bottom: 5px !important;
    }
</style>

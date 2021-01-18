<template>
    <div>
        <admin-main></admin-main>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <router-link :to="{name:'account_purpose'}" class="btn btn-primary"><i class="fa fa-arrow-right"></i></router-link>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                    <li class="active">purpose</li>
                </ol>
            </section>
            <section class="content">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-lg-offset-2">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Add purpose</h3>
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
                                        <input v-model="form.text" type="text" name="text"
                                               class="form-control" :class="{ 'is-invalid': form.errors.has('text') }"
                                               autofocus autocomplete="off" placeholder=" type purpose ">
                                        <has-error :form="form" field="text"></has-error>

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
    import {Form, HasError, AlertError} from 'vform'

    Vue.component(HasError.name, HasError)
    export default {
        name: "Add",
        created() {
            setTimeout(() => {
                this.loading = false
            }, 500)

            this.purpose_item() ;
        },
        data() {
            return {
                form: new Form({
                    text: "",
                    


                }),

                loading: true,
                error: ''
            }
        },

        methods: {

             update() {

                this.form.post('/api/account/purpose/update/'+this.$route.params.id, {
                    transformRequest: [function (data, headers) {
                        return objectToFormData(data)
                    }],
                    onUploadProgress: e => {
                        // Do whatever you want with the progress event
                        console.log(e)
                    }
                })
                    .then((resp) => {
                        //   console.log(resp)
                        if (resp.data.status == 'OK') {
                            this.$router.push({name: 'account_purpose'});
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
                        //  console.log(error)
                        this.error = 'some thing want to wrong';
                    })
            },

                purpose_item() {
                axios.get('/api/account/purpose/edit/'+this.$route.params.id)
                    .then((resp) => {
                         console.log(resp);
                        if (resp.data.status == 'OK') {
                            this.form.text = resp.data.purpose.text;
                            this.loading = false

                        }
                    })
                    .catch((error) => {
                        console.log(error);
                    })
            },

        },

    }
</script>

<style scoped>
    .mb-2 {
        margin-bottom: 5px !important;
    }
</style>

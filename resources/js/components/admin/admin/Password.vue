<template>
    <div>
        <admin-main></admin-main>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <router-link :to="{ name : 'admin'}" class="btn btn-primary"><i class="fa fa-arrow-right"></i></router-link>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                    <li class="active">password</li>
                </ol>
            </section>
            <section class="content">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-lg-offset-2">
                        <div class="box box-primary">
                            <div class="box-header text-center with-border">
                                <h3 class="box-title">Change password</h3>
                            </div>
                            <div class="box-body">
                                <h1 v-if="loading"><i class="fa fa-spinner fa-spin"></i></h1>
                                <form v-else @submit.prevent="updatePassword" @keydown="form.onKeydown($event)"
                                      enctype="multipart/form-data">

                                    <div class="alert-danger alert" v-if="error">
                                        {{error}}
                                    </div>
                           
                                    <div class="form-group">
                                        <label>Current Password</label>
                                        <input v-model="form.old_password" type="password" name="old_password"
                                               class="form-control" :class="{ 'is-invalid': form.errors.has('old_password') }"
                                               autofocus autocomplete="off" placeholder="your current password">
                                        <has-error :form="form" field="old_password"></has-error>

                                    </div>

                                    
                                    <div class="form-group">
                                        <label>new Password</label>
                                        <input v-model="form.new_password" type="password" name="new_password"
                                               class="form-control" :class="{ 'is-invalid': form.errors.has('new_password') }"
                                               autofocus autocomplete="off" placeholder="your new password">
                                        <has-error :form="form" field="new_password"></has-error>

                                    </div>

                           
                                    <br/>
                                    <button :disabled="form.busy" type="submit" class="btn btn-primary"><i
                                        class="fa fa-spin fa-spinner" v-if="form.busy"></i>update 
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
        name: "Add",
        created() {

            console.log(this.$route.params.id)
            this.adminId = this.$route.params.id;
            this.getAdmin();
            setTimeout(() => {
                this.loading = false
            }, 500)
        },
        data() {
            return {
                form: new Form({
                   old_password: "",
                   new_password : "",


                }),
                loading: true,
                error: '',


            }
        },

        methods: {

            getAdmin() {
                axios.get('/edit/admin/' + this.$route.params.id)
                    .then((resp) => {
                        console.log(resp)
                        if (resp.data.status == 'SUCCESS') {
                            this.form.name = resp.data.admin.name;
                            this.form.email = resp.data.admin.email;
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
            
            updatePassword() {

                this.form.post('/update/admin/password/'+this.$route.params.id, {
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
                       if(resp.data){
                           Swal.fire({
                               type:'info',
                               text:resp.data.message ,
                           });
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

<style scoped>
    .mb-2 {
        margin-bottom: 5px !important;
    }
</style>

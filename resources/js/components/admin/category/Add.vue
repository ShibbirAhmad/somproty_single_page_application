<template>
    <div>
        <admin-main></admin-main>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <router-link :to="{ name: 'category'}" class="btn btn-primary"><i class="fa fa-arrow-right"></i></router-link>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                    <li class="active">Category</li>
                </ol>
            </section>
            <section class="content">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-lg-offset-2">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Add Category</h3>
                            </div>
                            <div class="box-body">
                                <h1  v-if="loading"><i class="fa fa-spin fa-spinner"></i></h1>
                                 <form @submit.prevent="add" v-else @keydown="form.onKeydown($event)"
                                      enctype="multipart/form-data">
                                     <div class="alert-danger alert" v-if="error">
                                         {{error}}
                                     </div>
                                    <div class="form-group">
                                        <label>Category Name</label>
                                        <input v-model="form.name" type="text" name="name"
                                               class="form-control"  :class="{ 'is-invalid': form.errors.has('name') }"
                                               autofocus autocomplete="off" placeholder="Electronics">
                                        <has-error :form="form" field="name"></has-error>

                                    </div>
                                    <div class="form-group">
                                        <label>Category Image</label>
                                        <input class="form-control" :class="{ 'is-invalid': form.errors.has('image') }"
                                               type="file" @change="uploadImage" name="image">
                                        <has-error :form="form" field="image"></has-error>
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

            setTimeout(()=>{
                this.loading=false
            },500)
        },
        data() {
            return {
                form: new Form({
                    name: "",
                    image: "",

                }),
                error:'',
                loading:true
            }
        },

        methods: {

            add() {
                this.form.post('/category/add',{
                    transformRequest: [function (data, headers) {
                        return objectToFormData(data)
                    }],
                })
                    .then((resp) => {
                        console.log(resp)
                        if (resp.data.status == 'SUCCESS') {
                            this.$router.push({name: 'category'});
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
            uploadImage(e) {
                const file = e.target.files[0]
                this.form.image = file

            },
            read(image) {
                let reader = new FileReader();
                reader.readAsDataURL(image);
                reader.onload = e => {
                    this.form.image = e.target.result;
                }

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

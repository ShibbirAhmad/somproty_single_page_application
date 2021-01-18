<template>
    <div>
        <admin-main></admin-main>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <router-link :to="{name:'SubCategory'}" class="btn btn-primary"><i class="fa fa-arrow-right"></i></router-link>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                    <li class="active">Sub Category</li>
                </ol>
            </section>
            <section class="content">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-lg-offset-2">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Edit sub category </h3>
                            </div>
                            <div class="box-body">
                                <h1 v-if="loading"><i class="fa fa-spin fa-spinner"></i></h1>
                                <form @submit.prevent="update" v-else @keydown="form.onKeydown($event)"
                                      enctype="multipart/form-data">
                                    <div class="alert-danger alert" v-if="error">
                                        {{error}}
                                    </div>
                                    <div class="form-group">
                                        <label>sub category Name</label>
                                        <input v-model="form.name" type="text" name="name"
                                               class="form-control" :class="{ 'is-invalid': form.errors.has('category') }"
                                               autofocus autocomplete="off" placeholder="Laptop">
                                        <has-error :form="form" field="name"></has-error>

                                    </div>
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select class="form-control" name="category" v-model="form.category"
                                                :class="{ 'is-invalid': form.errors.has('name') }">
                                            <option v-for="category in categories" :value="category.id">
                                                {{category.name}}
                                            </option>
                                        </select>
                                        <has-error :form="form" field="category"></has-error>

                                    </div>
                                    <div class="form-group">
                                        <label>Sub category Image</label>
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
        name: "subCategory",
        created() {
            this.category();
            this.edit();
            setTimeout(() => {
                this.loading = false
            }, 500)
        },
        data() {
            return {
                form: new Form({
                    name: "",
                    image: "",
                    category: ''
                }),
                error: '',
                loading: true,
                categories: ''
            }
        },

        methods: {
            category() {
                axios.get('/others')
                    .then((resp) => {
                        console.log(resp)
                        //  console.log(resp.data.admins.data)
                        if (resp.data.status == 'SUCCESS') {
                            this.categories = resp.data.categories;
                        }

                    })
                    .catch((error) => {
                        console.log(error)
                        this.$toasted.show('some thing want to wrong', {
                            type: "error",
                            position: 'top-center',
                            duration: 5000
                        });
                    })
            },
            edit() {
                axios.get('/edit/subCategory/' + this.$route.params.id)
                    .then((resp) => {
                        //console.log(resp)
                        //  console.log(resp.data.admins.data)
                        if (resp.data.status == 'SUCCESS') {
                            this.form.name = resp.data.subCategory.name;
                            this.form.category = resp.data.subCategory.category_id;
                        } else {
                            this.error = "some thing want to wrong";

                        }

                    })
                    .catch((error) => {
                        this.error = "some thing want to wrong";

                        this.$toasted.show('some thing want to wrong', {
                            type: "error",
                            position: 'top-center',
                            duration: 5000
                        });
                    })
            },

            update() {
                this.form.post('/update/subCategory/'+this.$route.params.id, {
                    transformRequest: [function (data, headers) {
                        return objectToFormData(data)
                    }],
                })
                    .then((resp) => {
                        console.log(resp)
                        if (resp.data.status == 'SUCCESS') {
                            this.$router.push({name: 'SubCategory'});
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

                        this.$toasted.show('some thing want to wrong', {
                            type: "error",
                            position: 'top-center',
                            duration: 5000
                        });
                    })
            },
            uploadImage(e) {
                const file = e.target.files[0]
                this.form.image = file

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

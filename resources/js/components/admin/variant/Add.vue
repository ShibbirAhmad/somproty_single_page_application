<template>
    <div>
        <admin-main></admin-main>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <router-link :to="{name:'variant'}" class="btn btn-primary"><i class="fa fa-arrow-right"></i>
                    </router-link>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                    <li class="active">Variant</li>
                </ol>
            </section>
            <section class="content">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-lg-offset-2">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Add Variant</h3>
                            </div>
                            <div class="box-body">
                                <h1 v-if="loading"><i class="fa fa-spin fa-spinner"></i></h1>
                                <form @submit.prevent="add" v-else @keydown="form.onKeydown($event)"
                                      enctype="multipart/form-data">
                                    <div class="alert-danger alert" v-if="error">
                                        {{error}}
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" name="attribute" v-model="form.attribute">
                                            <option value="">Select attribute</option>
                                            <option v-for="attribute in attributes" :class="{ 'is-invalid': form.errors.has('attribute') }" :value="attribute.id">{{attribute.name}}</option>
                                        </select>
                                        <has-error :form="form" field="attribute"></has-error>

                                    </div>
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input class="form-control" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }"
                                               type="text" name="name" placeholder="Ex:Size">
                                        <has-error :form="form" field="name"></has-error>
                                    </div>

                                    <!--                                    <img :src="image" style="width: 500px;">-->
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
        created() {
            this.attribute();
            setTimeout(() => {
                this.loading = false
            }, 500)
        },
        data() {
            return {
                form: new Form({
                    name: "",
                    attribute:"",
                }),
                error: '',
                loading: true,
                image: '',
                attributes:''
            }
        },

        methods: {
            add() {
                this.form.post('/variant/add', {
                    transformRequest: [function (data, headers) {
                        return objectToFormData(data)
                    }],
                })
                    .then((resp) => {
                        console.log(resp)
                        if (resp.data.status == 'SUCCESS') {
                            this.$router.push({name: 'variant'});
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
                        this.$toasted.show('some thing want to wrong', {
                            type: "error",
                            position: 'top-center',
                            duration: 5000
                        });
                    })
            },
            attribute() {
                axios.get('/list/attribute')
                    .then((resp) => {
                        if (resp.data.status == 'SUCCESS') {
                            this.attributes = resp.data.attributes;

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


        },
        computed: {}
    }
</script>

<style scoped>
    .mb-2 {
        margin-bottom: 5px !important;
    }
</style>

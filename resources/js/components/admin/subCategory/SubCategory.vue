<template>
    <div>
        <admin-main></admin-main>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <router-link :to="{name:'subcategoryAdd'}" class="btn btn-primary"><i class="fa fa-plus"></i></router-link>
                    <router-link :to="{name:'category'}" class="btn btn-success">category</router-link>
                    <router-link :to="{name:'subSubCategory'}" class="btn btn-primary">sub sub category</router-link>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                    <li class="active">Sub category</li>
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
                                            <h3 class="box-title">sub category table</h3>

                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" placeholder="Enter sub category name"
                                                   v-model="search" @keyup="searchResult">
                                        </div>

                                    </div>
                                </div>
                                <div class="box-body">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <h1 v-if="loading"><i class="fa fa-spin fa-spinner"></i></h1>
                                        <tr v-for="(subCategory,index) in subCategories.data" :key="index" v-else>
                                            <td scope="row">{{index+1}}</td>
                                            <td>{{subCategory.name}}</td>
                                            <td>{{subCategory.category.name}}</td>
                                            <td>
                                                <img v-if="subCategory.image" :src="basePath+subCategory.image"
                                                     class="img-circle small-image" alt="User Image">
                                                <img v-else :src="basePath+'images/static/noimage.png'"
                                                     class="img-circle small-image" alt="User Image">
                                            </td>

                                            <td>
                                                <span v-if="subCategory.status==1" class="badge">active</span>
                                                <span v-else class="badge">De-active</span>
                                            </td>

                                            <td>
                                                <router-link :to="{ name: 'subcategoryEdit', params: { id: subCategory.id }}"
                                                             class="btn btn-success btn-sm"><i
                                                    class="fa fa-edit"></i></router-link>

                                                <a class="btn btn-warning" title="De-active" @click="deActive(subCategory)"
                                                   v-if="subCategory.status==1"><i class="fa fa-ban"></i></a>
                                                <a class="btn btn-primary" title="active" @click="active(subCategory)"
                                                   v-else><i
                                                    class="fa fa-check"></i></a>

                                            </td>

                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="box-footer">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <pagination :data="subCategories"
                                                        @pagination-change-page="getPagination"></pagination>

                                        </div>
                                        <div class="col-lg-6 mt-1" style="margin-top: 25px;text-align:right;">
                                            <p>Showing <strong>{{subCategories.from}}</strong> to
                                                <strong>{{subCategories.to}}</strong> of total
                                                <strong>{{subCategories.total}}</strong> entries
                                            </p>
                                        </div>
                                    </div>

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
                this.subCategory();
            }, 500)
        },
        data() {
            return {
                subCategories: {},
                loading: true,
                search: '',
                basePath:this.$store.state.image_base_link,
            }
        },
        methods: {

            subCategory() {
                axios.get('/list/subCategory')
                    .then((resp) => {
                        //console.log(resp.data.subCategories[0].category)
                        //  console.log(resp.data.admins.data)
                        if (resp.data.status == 'SUCCESS') {
                            this.subCategories = resp.data.subCategories;
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

            active(subCategory) {
                axios.get('/active/subCategory/' + subCategory.id)
                    .then((resp) => {
                        console.log(resp)
                        if (resp.data.status == 'SUCCESS') {
                            this.subCategory();
                            this.$toasted.show(resp.data.message, {
                                type: "success",
                                position: 'top-center',
                                duration: 4000
                            });

                        } else {
                            this.$toasted.show('some thing want to wrong', {
                                type: "error",
                                position: 'top-center',
                                duration: 4000
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
            deActive(subCategory) {
                axios.get('/deActive/subCategory/' + subCategory.id)
                    .then((resp) => {
                        console.log(resp)
                        if (resp.data.status == 'SUCCESS') {
                            this.subCategory();
                            this.$toasted.show(resp.data.message, {
                                type: "success",
                                position: 'top-center',
                                duration: 4000
                            });

                        } else {
                            this.$toasted.show('some thing want to wrong', {
                                type: "error",
                                position: 'top-center',
                                duration: 4000
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
            searchResult() {
                if (this.search.length > 1) {
                    this.loading = true;
                    axios.get('/search/subCategory/' + this.search)
                        .then((resp) => {

                            if (resp.data.status == 'SUCCESS') {
                                this.loading = false;
                                this.subCategories = resp.data.subCategories;

                            } else {
                                this.$toasted.show('some thing want to wrong', {
                                    type: "error",
                                    position: 'top-center',
                                    duration: 4000
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
                } else {
                    this.subCategory()
                }

            },
            getPagination(page = 1) {
                this.loading=true;
                axios.get('/list/subCategory?page=' + page)
                    .then(response => {

                        this.subCategories = response.data.subCategories;
                        this.loading=false;
                    });
            }

        }
    }

</script>

<style scoped>

</style>

<template>
    <div>
        <admin-main></admin-main>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <router-link :to="{ name: 'categoryAdd'}" class="btn btn-primary"><i class="fa fa-plus"></i></router-link>
                    <router-link :to="{ name: 'SubCategory'}" class="btn btn-success">sub category</router-link>
                    <router-link :to="{ name: 'subSubCategory'}" class="btn btn-primary">sub sub category</router-link>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                    <li class="active">Category</li>
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
                                            <h3 class="box-title">Category table</h3>

                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" placeholder="Enter Category name"
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
                                            <th scope="col">Image</th>
                                            <th scope="col">isSelected</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <h1 v-if="loading"><i class="fa fa-spin fa-spinner"></i></h1>
                                        <tr v-for="(category,index) in categories.data" v-else :key="index">
                                            <td scope="row">{{index+1}}</td>
                                            <td>{{category.name}}</td>
                                            <td>
                                                <img v-if="category.icon_image"  :src="basePath+category.icon_image"
                                                     class="img-circle small-image" alt="Category Image">
                                                <img v-else :src="basePath+'images/static/noimage.png'"
                                                     class="img-circle small-image" alt="Category Image">
                                            </td>
                                            <td>
                                                <span v-if="category.is_selected==1" class="badge"><i
                                                    class="fa fa-check"></i></span>
                                                <span v-else class="badge"><i class="fa fa-close"></i>
                                                </span>
                                            </td>
                                            <td>
                                                <span v-if="category.status==1" class="badge">active</span>
                                                <span v-else class="badge">De-active</span>
                                            </td>

                                            <td>
                                                <router-link
                                                    :to="{ name: 'CategoryEdit', params: { categoryId: category.id }}"
                                                    class="btn btn-success btn-sm"><i
                                                    class="fa fa-edit"></i></router-link>
                                                <a class="btn btn-danger" title="un-selected"
                                                   @click="unselected(category)"
                                                   v-if="category.is_selected==1"><i class="fa fa-close"></i></a>
                                                <a class="btn btn-primary" title="selected" @click="selected(category)"
                                                   v-else><i
                                                    class="fa fa-chain"></i></a>

                                                <a class="btn btn-warning" title="De-active" @click="deActive(category)"
                                                   v-if="category.status==1"><i class="fa fa-ban"></i></a>
                                                <a class="btn btn-primary" title="active" @click="active(category)"
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
                                            <pagination :data="categories"
                                                        @pagination-change-page="getPagination"></pagination>

                                        </div>
                                        <div class="col-lg-6 mt-1" style="margin-top: 25px;text-align:right;">
                                            <p>Showing <strong>{{categories.from}}</strong> to
                                                <strong>{{categories.to}}</strong> of total
                                                <strong>{{categories.total}}</strong> entries
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
                this.category();
            }, 500)
        },
        data() {
            return {
                categories: {},
                loading: true,
                search: '',
                basePath:this.$store.state.image_base_link,
            }
        },
        methods: {

            category() {
                axios.get('/list/category')
                    .then((resp) => {
                        console.log(resp)
                        //  console.log(resp.data.admins.data)
                        if (resp.data.status == 'SUCCESS') {
                            this.categories = resp.data.categories;
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
            unselected(category) {
                axios.get('/unselected/category/' + category.id)
                    .then((resp) => {
                        //console.log(resp)
                        if (resp.data.status == 'SUCCESS') {
                            this.category();
                            this.$toasted.show(resp.data.message, {
                                type: "success",
                                position: 'top-center',
                                duration: 4000
                            });

                        } else {
                            this.$toasted.show('something want to wrong', {
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
            selected(category) {
                axios.get('/selected/category/' + category.id)
                    .then((resp) => {
                      //  console.log(resp)
                        if (resp.data.status == 'SUCCESS') {
                            this.category();
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
            active(category) {
                axios.get('/active/category/' + category.id)
                    .then((resp) => {
                     //   console.log(resp)
                        if (resp.data.status == 'SUCCESS') {
                            this.category();
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
            deActive(category) {
                axios.get('/deActive/category/' + category.id)
                    .then((resp) => {
                     //   console.log(resp)
                        if (resp.data.status == 'SUCCESS') {
                            this.category();
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
                    axios.get('/search/category/' + this.search)
                        .then((resp) => {
                            console.log(resp)
                            if (resp.data.status == 'SUCCESS') {
                                this.loading = false;
                                this.categories = resp.data.categories;

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
                    this.category()
                }

            },
            getPagination(page = 1) {
                this.loading=true;
                axios.get('/list/category?page=' + page)
                    .then(response => {
                        this.loading=false;
                        this.categories = response.data.categories;
                    });
            }

        }
    }

</script>

<style scoped>

</style>

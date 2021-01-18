<template>
    <div>
        <admin-main></admin-main>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <router-link  :to="{name:'commentAdd'}" class="btn btn-primary"><i class="fa fa-plus"></i></router-link>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                    <li class="active">Comment</li>
                </ol>
            </section>
            <section class="content">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-lg-offset-1">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Comment table</h3>
                                </div>
                                <div class="box-body">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">status</th>
                                            <th scope="col">Action</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <h1 class="text-center" v-if="loading"><i class="fa fa-spin fa-spinner"></i>
                                        </h1>
                                        <tr v-for="(comment,index) in comments.data">
                                            <td scope="row">{{index+1}}</td>
                                            <td>{{comment.name}}</td>
                                            <td>
                                                <span class="badge" v-if="comment.status==1">Active</span>
                                                <span class="badge text-bold" v-else>De-Active</span>
                                            </td>
                                            <td>

                                                <router-link
                                                    :to="{ name: 'editComment', params: { id: comment.id }}"
                                                    class="btn btn-success btn-sm"><i
                                                    class="fa fa-edit"></i></router-link>
                                                <a class="btn btn-warning" title="De-active" @click="deActive(comment)"
                                                   v-if="comment.status==1"><i class="fa fa-ban"></i></a>
                                                <a class="btn btn-primary" title="active" @click="active(comment)"
                                                   v-else><i
                                                    class="fa fa-check"></i></a>

                                                <a class="btn btn-danger" title="active" @click="destroy(comment)"
                                                ><i
                                                    class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        </tbody>

                                    </table>

                                </div>
                                <div class="box-footer">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <pagination :data="comments"
                                                        @pagination-change-page="getPagination">

                                            </pagination>

                                        </div>
                                        <div class="col-lg-6 mt-1" style="margin-top: 25px;text-align:right;">
                                            <p>Showing <strong>{{comments.from}}</strong> to
                                                <strong>{{comments.to}}</strong> of total
                                                <strong>{{comments.total}}</strong> entries
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

    export default {
        created() {
            setTimeout(() => {
                this.commentList();
            }, 500);
            // this.getResults();

        },
        data() {
            return {
                comments: {},
                loading: true,
                basePath: 'storage/'
            }
        },
        methods: {
            commentList() {
                axios.get('/list/comment')
                    .then((resp) => {
                        console.log(resp)
                        if (resp.data.status == 'SUCCESS') {
                            this.comments = resp.data.comments;
                            this.loading = false

                        }
                    })
                    .catch((error) => {
                        console.log(error);
                    })
            },
            deActive(comment) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't de-active this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!'
                }).then((result) => {
                    if (result.value) {

                        axios.get('/deActive/comment/' + comment.id)
                            .then((resp) => {
                                //  console.log(resp)
                                if (resp.data.status == 'SUCCESS') {
                                    this.commentList();
                                    this.$toasted.show(resp.data.message, {
                                        position: 'top-center',
                                        type: 'success',
                                        duration: 4000
                                    });
                                } else {
                                    this.$toasted.show('some thing want to wrong', {
                                        position: 'top-center',
                                        type: 'error',
                                        duration: 4000
                                    });
                                }

                            })
                            .catch((error) => {
                                // console.log(error)
                                this.$toasted.show('some thing want to wrong', {
                                    position: 'top-center',
                                    type: 'error',
                                    duration: 4000
                                });
                            })


                    } else {
                        this.$toasted.show('OK ! no action here', {
                            position: 'top-center',
                            type: 'info',
                            duration: 3000
                        });
                    }
                })
            },
            active(comment) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't active this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!'
                }).then((result) => {
                    if (result.value) {

                        axios.get('/active/comment/' + comment.id)
                            .then((resp) => {
                                if (resp.data.status == 'SUCCESS') {
                                    this.commentList();
                                    this.$toasted.show(resp.data.message, {
                                        position: 'top-center',
                                        type: 'success',
                                        duration: 4000
                                    });
                                } else {
                                    this.$toasted.show('some thing want to wrong', {
                                        position: 'top-center',
                                        type: 'error',
                                        duration: 4000
                                    });
                                }

                            })
                            .catch((error) => {
                                this.$toasted.show('some thing want to wrong', {
                                    position: 'top-center',
                                    type: 'error',
                                    duration: 4000
                                });
                            })


                    } else {
                        this.$toasted.show('Ok ! no action here', {
                            position: 'top-center',
                            type: 'info',
                            duration: 3000
                        });
                    }
                })
            },
            destroy(comment) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't delete this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes!'
                }).then((result) => {
                    if (result.value) {

                        axios.get('/destroy/comment/' + comment.id)
                            .then((resp) => {
                                if (resp.data.status == 'SUCCESS') {
                                    this.commentList();
                                    this.$toasted.show(resp.data.message, {
                                        position: 'top-center',
                                        type: 'success',
                                        duration: 4000
                                    });
                                } else {
                                    this.$toasted.show('some thing want to wrong', {
                                        position: 'top-center',
                                        type: 'error',
                                        duration: 4000
                                    });
                                }

                            })
                            .catch((error) => {
                                this.$toasted.show('some thing want to wrong', {
                                    position: 'top-center',
                                    type: 'error',
                                    duration: 4000
                                });
                            })


                    } else {
                        this.$toasted.show('Ok ! no action here', {
                            position: 'top-center',
                            type: 'info',
                            duration: 3000
                        });
                    }
                })
            },
            getPagination(page = 1) {
                this.loading = true;
                axios.get('/list/comment?page=' + page)
                    .then(response => {
                        this.loading = false;
                        this.comments = response.data.comments;
                    });
            }

        },
        computed: {}
    }

</script>

<style scoped>

</style>

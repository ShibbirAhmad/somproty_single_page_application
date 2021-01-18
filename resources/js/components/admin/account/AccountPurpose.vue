<template>
    <div>
        <admin-main></admin-main>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <router-link :to="{name:'account_purpose_add'}" class="btn btn-primary"><i class="fa fa-plus"></i></router-link>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                    <li class="active">Account Purpose</li>
                </ol>
            </section>
            <section class="content">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-lg-offset-1">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Purpose </h3>
                                </div>
                                <div class="box-body">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Credit Or Debit purpose </th>
                                            <th scope="col">Action</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <h1 class="text-center" v-if="loading"><i class="fa fa-spin fa-spinner"></i>
                                        </h1>
                                        <tr v-for="(purpose,index) in purposes.data" :key="index">
                                            <td scope="row">{{index+1}}</td>
                                            <td>{{purpose ? purpose.text : '' }}</td>
                                            <td>

                                                <router-link
                                                    :to="{ name: 'account_purpose_edit', params: { id: purpose.id }}"
                                                    class="btn btn-success btn-sm"><i
                                                    class="fa fa-edit"></i></router-link>
                                                
                                            </td>
                                        </tr>
                                        </tbody>

                                    </table>

                                </div>
                                <div class="box-footer">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <pagination :data="purposes"
                                                        @pagination-change-page="purposeList">

                                            </pagination>

                                        </div>
                                        <div class="col-lg-6 mt-1" style="margin-top: 25px;text-align:right;">
                                            <p>Showing <strong>{{purposes.from}}</strong> to
                                                <strong>{{purposes.to}}</strong> of total
                                                <strong>{{purposes.total}}</strong> entries
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
         this.purposeList();
      
       },
        data() {
            return {
                purposes: {},
                loading: true,
          }
        },
        methods: {
            purposeList(page=1) {
                axios.get('/api/account/purpose/list?page='+page)
                    .then((resp) => {
                         console.log(resp);
                        if (resp.data.status == 'OK') {
                            this.purposes = resp.data.purposes;
                            this.loading = false

                        }
                    })
                    .catch((error) => {
                        console.log(error);
                    })
            },
         
           
        },
        computed: {}
    }

</script>

<style scoped>

</style>

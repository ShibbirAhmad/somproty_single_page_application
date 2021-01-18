<template >
    <div>
        <admin-main></admin-main>
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <router-link :to="{name:'roleAdd'}" class="btn btn-primary"><i class="fa fa-plus"></i></router-link>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                    <li class="active">Role</li>
                </ol>
            </section>
            <section class="content">
                <div class="container">
                    <div class="row justify-content-center" >
                        <div class="col-lg-8 col-lg-offset-1">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Roleee table</h3>
                                </div>
                                <div class="box-body">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Action</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <h1 class="text-center" v-if="loading"><i class="fa fa-spin fa-spinner"></i>
                                        </h1>
                                        <tr v-for="(role,index) in roles" v-bind:key="index">
                                            <td scope="row">{{index+1}}</td>
                                            <td>{{role.name}}</td>
                                          
                                            <td>
                                         <router-link  :to="{ name: 'editAdmin', params: { adminId: role.id }}"
                                                             class="btn btn-success btn-sm">Edit</router-link>

                                        <router-link :to="{ name: 'EditPermissions', params: { id: role.id }}"
                                                             class="btn btn-primary btn-sm">Permissions </router-link>
                                              </td>
                                        </tr>
                                        </tbody>

                                    </table>
                                    
                                    </div>
                                <div class="box-footer">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            

                                        </div>
                                        <div class="col-lg-6 mt-1" style="margin-top: 25px;text-align:right;">
                                            <p>Showing <strong>{{roles.from}}</strong> to
                                                <strong>{{roles.to}}</strong> of total
                                                <strong>{{roles.total}}</strong> entries
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
             this.roleList();
             },
        data() {
            return {
                roles: {},
                loading: true,
                basePath: 'storage/',
                pageAcccess:true
            }
        },
        methods: {
            roleList() {
                axios.get('/api/roles/')
                    .then((resp) => {

                        //check the page right permisson view when directly access by url
                        let checkAcces=this.$can('View Role');
                        if(checkAcces==false){
                                this.pageAcccess=false;
                        }
                        if(this.$can('View Role')==false){
                            this.viewPermisson=false;
                        }  if (resp.data) {
                            this.roles = resp.data;
                            this.loading = false;
                        }
                     })
                    .catch((error) => {
                        console.log(error);
                    })
            },
           
        },

       
      
    }

</script>



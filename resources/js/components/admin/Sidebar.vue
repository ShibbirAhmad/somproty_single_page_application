<template>
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="admin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>Alexander Pierce</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
                </div>
            </form>

            <ul class="sidebar-menu" data-widget="tree">
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                        <span class="pull-right-container">
                         <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a><i class="fa fa-circle-o"></i>sub sub category </a></li>
                        <li><a><i class="fa fa-circle-o"></i>sub sub category </a></li>
                        <li><a><i class="fa fa-circle-o"></i>sub sub category </a></li>
                </ul>
                </li>
                <li class="treeview" >
                    <router-link to="category">
                        <a href="#">
                            <i class="fa fa-dashboard"></i> <span>Category</span>
                            <span class="pull-right-container">
                           <i class="fa fa-angle-left pull-right"></i>
                         </span>
                        </a>
                    </router-link>
                </li>
                <li class="treeview">
                    <router-link to="slider">
                        <a href="#">
                            <i class="fa fa-sliders"></i> <span> Slider</span>

                        </a>
                    </router-link>
                </li>
                <li class="treeview">
                    <router-link to="/attribute">
                        <a href="#">
                            <i class="fa fa-sliders"></i> <span> Attribute</span>

                        </a>
                    </router-link>
                </li>
                <li class="treeview">
                    <router-link to="listAdmin">
                        <a href="#">
                            <i class="fa fa-dashboard"></i> <span>Admin</span>
                            <span class="pull-right-container">
                           <i class="fa fa-angle-left pull-right"></i>
                         </span>
                        </a>
                    </router-link>
                </li>


            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

</template>

<script>
    export default {
        name: "Sidebar"
    }


</script>

<style scoped>

</style>

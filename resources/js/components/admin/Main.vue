<template>
    <div>
        <admin-nav></admin-nav>
    </div>

</template>

<script>
    Vue.component('admin-side', require('./Sidebar.vue').default);
    Vue.component('admin-nav', require('./Navbar.vue').default);
    export default {
        name: "Main.vue",
    }
</script>


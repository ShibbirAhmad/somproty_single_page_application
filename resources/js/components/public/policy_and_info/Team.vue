<template>
  <div>
    <loading
      :active.sync="isLoading"
      :can-cancel="true"
      :is-full-page="fullPage"
    ></loading>

    <frontend-header></frontend-header>
    <div class="row text-center">
      <div
        :style="{
          height: '400px',
          marginTop: '-10px',
          backgroundImage: 'url(/public/images/mm.jpg)',
          backgroundPosition: 'center center',
          backgroundSize: 'cover',
        }"
        class="background_image"
      ></div>
    </div>

    <div class="row">
      <div style="background-color: #eee" class="container-fluid">
        <div style="margin-bottom: 50px" class="container">
          <div v-for="(member, index) in team" :key="index" class="col-md-3 col-sm-6">
            <div class="card box profile_container text-center shadow box-white">
              <div class="inside_top"></div>
              <img class="profile_image" :src="base_url + member.avator" alt="" />
              <div class="inside_bottom"></div>
              <h4 class="heading">{{ member.name }}</h4>
              <p>{{ member.designation }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <frontend-footer></frontend-footer>
  </div>
</template>
<script>
import Loading from "vue-loading-overlay";
import "vue-loading-overlay/dist/vue-loading.css";
export default {
  created() {
    this.getTeam();
  },
  data() {
    return {
      isLoading: true,
      fullPage: true,
      team: "",
      base_url: this.$store.state.image_base_link,
    };
  },
  methods: {
    getTeam() {
      axios
        .get("/_public/team/members")
        .then((resp) => {
          console.log(resp);
          if (resp.data.status == "OK") {
            this.team = resp.data.team;
            this.isLoading = false;
          }
        })
        .catch();
    },
  },
  components: {
    Loading,
  },
};
</script>

<style scoped>
.profile_image {
  margin-top: -70px;
  width: 150px;
  height: 150px;
  border-radius: 50%;
  border: 5px solid #fff;
}
.desc_info p {
  padding: 5px;
  margin: 10px;
  padding-bottom: 20px;
}

.profile_container {
  border-radius: 10px;
  margin-top: 50px;
  background: #fff;
  padding-bottom: 20px;
}

.inside_top {
  width: 100%;
  height: 90px;
  background: #ff4d03;
  border-radius: 5px;
}

.inside_bottom {
  width: 100%;
  background-color: #fff;
}
h4 {
  font-size: 16px;
}
p {
  font-size: 14px;
  line-height: 10px;
}
</style>

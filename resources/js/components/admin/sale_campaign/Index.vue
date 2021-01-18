<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <router-link :to="{ name: 'add_sale_campaign' }" class="btn btn-primary"
            ><i class="fa fa-plus"></i
          ></router-link>
        </h1>
        <ol class="breadcrumb">
          <li>
            <a href="#"> <i class="fa fa-dashboard"></i>Dashboard </a>
          </li>
          <li class="active">Sale Campaign</li>
        </ol>
      </section>
      <section class="content">
        <div class="row justify-content-center">
          <div class="col-lg-8 col-lg-offset-2">
            <div class="box box-primary">
              <div class="box-header text-center with-border">
                <h2 class="box-title">Sale Campaign</h2>
              </div>
              <div class="box-body">
                <div class="alert-danger alert" v-if="error">{{ error }}</div>

                <table class="table text-center">
                  <thead>
                    <tr>
                      <th scope="col">Serial</th>
                      <th scope="col">Campaign Name</th>
                      <th scope="col">Duration</th>
                      <th scope="col">Display Position</th>
                      <th scope="col">Status</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <h1 class="text-center" v-if="loading">
                      <i class="fa fa-spin fa-spinner"></i>
                    </h1>
                    <tr
                      v-for="(sale_campaign, index) in campaingns"
                      :key="index"
                    >
                      <td>{{ index + 1 }}</td>
                      <td>
                        <router-link
                          :to="{
                            name: 'edit_sale_campaign',
                            params: { id: sale_campaign.id },
                          }"
                        >
                          {{ sale_campaign.name }}
                        </router-link>
                      </td>
                      <td>{{ sale_campaign.expired_date }}</td>
                      <td>
                        <span class="badge btn-success">
                          {{
                            sale_campaign.order_by
                              ? sale_campaign.order_by
                              : "not define"
                          }}
                        </span>
                      </td>
                      <td>
                        <span
                          v-if="sale_campaign.status == 1"
                          class="badge btn-success"
                          >Active</span
                        >
                        <span v-else class="badge btn-warning">De-Active</span>
                      </td>
                      <td>
                        <router-link
                          :to="{
                            name: 'edit_sale_campaign',
                            params: { id: sale_campaign.id },
                          }"
                          class="btn btn-sm btn-success"
                        >
                          <i class="fa fa-edit"></i>
                        </router-link>

                        <button
                          v-if="sale_campaign.status == 1"
                          class="btn btn-sm btn-warning"
                        >
                          <i
                            class="fa fa-ban"
                            @click="deActive(sale_campaign.id)"
                          >
                          </i>
                        </button>
                        <button v-else class="btn btn-sm btn-success">
                          <i
                            class="fa fa-check"
                            @click="active(sale_campaign.id)"
                          >
                          </i>
                        </button>

                        <a class="btn btn-sm btn-danger">
                          <i
                            @click="
                              trash_sale_campaign(sale_campaign.id, index)
                            "
                            class="fa fa-trash"
                          ></i>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</template>


<script>
import Vue from "vue";
import { Form, HasError, AlertError } from "vform";

Vue.component(HasError.name, HasError);
export default {
  created() {
    this.getSaleCampaigns();
  },
  data() {
    return {
      campaingns: "",
      error: "",
      loading: true,
    };
  },

  methods: {
    getSaleCampaigns() {
      axios.get("/api/sale/campaign/list").then((resp) => {
        console.log(resp);
        if (resp.data.status == "OK") {
          this.campaingns = resp.data.sale_campaigns;
          this.loading = false;
        }
      });
    },

    deActive(sale_campaign_id) {
      Swal.fire({
        title: "Are you sure?",
        text: "Do you want de-active this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes!",
      }).then((result) => {
        if (result.value) {
          axios
            .get("/api/sale/campaign/deActive/" + sale_campaign_id)
            .then((resp) => {
              if (resp.data.status == "OK") {
                this.getSaleCampaigns();
                this.$toasted.show(resp.data.message, {
                  position: "top-center",
                  type: "success",
                  duration: 4000,
                });
              } else {
                this.$toasted.show("some thing want to wrong", {
                  position: "top-center",
                  type: "error",
                  duration: 4000,
                });
              }
            });
        } else {
          this.$toasted.show("OK ! no action here", {
            position: "top-center",
            type: "info",
            duration: 3000,
          });
        }
      });
    },

    active(sale_campaign_id) {
      Swal.fire({
        title: "Are you sure?",
        text: "Do you want active this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes!",
      }).then((result) => {
        if (result.value) {
          axios
            .get("/api/sale/campaign/active/" + sale_campaign_id)
            .then((resp) => {
              if (resp.data.status == "OK") {
                this.getSaleCampaigns();
                this.$toasted.show(resp.data.message, {
                  position: "top-center",
                  type: "success",
                  duration: 4000,
                });
              } else {
                this.$toasted.show("some thing want to wrong", {
                  position: "top-center",
                  type: "error",
                  duration: 4000,
                });
              }
            });
        } else {
          this.$toasted.show("Ok ! no action here", {
            position: "top-center",
            type: "info",
            duration: 3000,
          });
        }
      });
    },

    trash_sale_campaign(sale_campaign_id, index) {
      if (confirm("Are you sure to remove")) {
        axios
          .get("/api/sale/campaign/remove/" + sale_campaign_id)
          .then((resp) => {
            console.log(resp);
            if (resp.data.status == "OK") {
              this.$toasted.show(resp.data.message, {
                type: "success",
                duration: 400,
                position: "top-center",
              });
              this.Campaigns.splice(index, 1);
            }
          });
      }
    },
  },
};
</script>

<style scoped>
input {
  cursor: pointer;
}

.color_group {
  margin-left: 20px;
}
</style>
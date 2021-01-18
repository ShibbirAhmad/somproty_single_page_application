<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <router-link :to="{ name: 'fondtransferAdd' }" class="btn btn-primary"
            ><i class="fa fa-plus"></i
          ></router-link>
        </h1>
        <ol class="breadcrumb">
          <li>
            <a href="#"><i class="fa fa-dashboard"></i>Dashboard</a>
          </li>
          <li class="active">Admin</li>
        </ol>
      </section>
      <section class="content">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8 col-lg-offset-1">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <div class="row mt-2">
                    <div class="col-lg-10">
                      <h3 class="box-title">Fund Transfer</h3>
                    </div>
                    <div class="col-md-2">
                      <select
                        @change="amountList"
                        v-model="items"
                        class="form-control"
                      >
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                        <option value="50">50</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="box-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                                                <th scope="col">Date</th>

                        <th scope="col">From</th>
                        <th scope="col">To</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Cost(%)</th>
                        <th scope="col">Create By</th>
                      </tr>
                    </thead>
                    <tbody>
                      <h1 class="text-center" v-if="loading">
                        <i class="fa fa-spin fa-spinner"></i>
                      </h1>
                      <tr
                        v-for="(
                          transfer_amount, index
                        ) in transfer_amount_list.data"
                        v-bind:key="index"
                      >
                        <td scope="row">{{ index + 1 }}</td>
                                                <td>{{ transfer_amount.created_at }}</td>

                        <td>{{ transfer_amount.from }}</td>
                        <td>{{ transfer_amount.to }}</td>
                        <td>{{ transfer_amount.amount }}</td>
                        <td>{{ transfer_amount.cost }}</td>
                        <td>{{ transfer_amount.creator_admin }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="box-footer">
                  <div class="row">
                    <div class="col-lg-6">
                      <pagination
                        :data="transfer_amount_list"
                        @pagination-change-page="amountList"
                        :limit="5"
                      >
                      </pagination>
                    </div>
                    <div
                      class="col-lg-6 mt-1"
                      style="margin-top: 25px; text-align: right"
                    >
                      <p> 
                        Showing
                        <strong>{{ transfer_amount_list.from }}</strong> to
                        <strong>{{ transfer_amount_list.to }}</strong> of total
                        <strong>{{ transfer_amount_list.total }}</strong>
                        entries
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
    this.amountList();
  },
  data() {
    return {
      transfer_amount_list: {},
      loading: true,
      basePath: this.$store.getters.image_base_link,
      items: 10,
      search: "",
    };
  },
  methods: {
    amountList(page = 1) {
      axios
        .get("/api/fond/transfer?page=" + page, {
          params: {
            items: this.items,
          },
        })
        .then((resp) => {
          if (resp.data.status == "OK") {
            this.transfer_amount_list = resp.data.transfer_amount_list;
            this.loading = false;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>

<style scoped>
</style>

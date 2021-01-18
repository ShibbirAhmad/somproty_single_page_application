<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <router-link
            :to="{ name: 'AddPurchaseFabrics' }"
            class="btn btn-primary"
            ><i class="fa fa-plus"></i
          ></router-link>
        </h1>
        <ol class="breadcrumb">
          <li>
            <a href="#"><i class="fa fa-dashboard"></i>Dashboard</a>
          </li>
          <li class="active">Purchase</li>
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
                      <h3 class="box-title">Fabrics Purchase</h3>
                    </div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-2">
                      <select
                        class="form-control"
                        v-model="item"
                        @change="purchaseList"
                      >
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
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
                        <th scope="col">Supplier</th>
                        <th scope="col">Invoice_no</th>
                        <th scope="col">Total_amount</th>
                        <th scope="col">Paid Amount</th>
                        <th scope="col">Due Amount</th>
                        <th>Memo</th>
                      </tr>
                    </thead>
                    <tbody>
                      <h1 v-if="loading">
                        <i class="fa fa-spin fa-spinner"></i>
                      </h1>
                      <tr
                        v-for="(purchase, index) in purchases.data"
                        v-else
                        :key="purchase.id"
                      >
                        <td scope="row">{{ index + 1 }}</td>
                        <td>{{ formatDate(purchase.purchase_date) }}</td>
                        <td>{{ purchase.supplier.company_name }}</td>

                        <td>{{ purchase.invoice_no }}</td>
                        <td>
                          {{ purchase.total }}
                        </td>
                        <td>
                          {{ purchase.paid }}
                        </td>
                        <td>
                          {{
                            parseInt(purchase.total) - parseInt(purchase.paid)
                          }}
                        </td>
                        <td>
                          <a
                            href="#"
                            v-if="!purchase.file"
                            @click.prevent="memoUpload(purchase.id)"
                            class="btn btn-sn btn-success"
                            ><i class="fa fa-file"></i
                          ></a>
                          <a
                            :href="basePath + purchase.file"
                            v-else
                            download
                            class="btn btn-sn btn-success"
                            ><i class="fa fa-file"></i
                          ></a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="box-footer">
                  <div class="row">
                    <div class="col-lg-6">
                      <pagination
                        :data="purchases"
                        @pagination-change-page="purchaseList"
                      ></pagination>
                    </div>
                    <div
                      class="col-lg-6 mt-1"
                      style="margin-top: 25px; text-align: right"
                    >
                      <p>
                        Showing <strong>{{ purchases.from }}</strong> to
                        <strong>{{ purchases.to }}</strong> of total
                        <strong>{{ purchases.total }}</strong> entries
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
  components: { Index },

  created() {
    this.purchaseList();
  },
  data() {
    return {
      purchases: {},
      loading: true,
      item: "10",
      basePath: this.$store.getters.image_base_link,
    };
  },
  methods: {
    purchaseList(page = 1) {
      axios
        .get("/api/list/purchase?page=" + page, {
          params: {
            item: this.item,
            status: 2,
          },
        })
        .then((resp) => {
          console.log(resp);
          //  console.log(resp.data.admins.data)
          if (resp.data.status == "SUCCESS") {
            this.purchases = resp.data.purchases;
            this.loading = false;
          } else {
            this.$toasted.show("some thing want to wrong", {
              type: "error",
              position: "top-center",
              duration: 5000,
            });
          }
        })
        .catch((error) => {
          this.$toasted.show("some thing want to wrong", {
            type: "error",
            position: "top-center",
            duration: 4000,
          });
        });
    },
    memoUpload(id) {
      Swal.fire({
        title: "Upload a file",
        input: "file",
      }).then((result) => {
        if (result.value) {
          let formData = new FormData();
          formData.append("file", result.value);
          formData.append("id", id);
          axios.post("/api/purchase/memo/upload", formData).then((resp) => {
            if (resp.data == "ok") {
              this.$toasted.show("file was uploaded", {
                type: "success",
                position: "top-center",
                duration: 3000,
              });
            } else {
              this.$toasted.show("Error Found", {
                type: "error",
                position: "top-center",
                duration: 3000,
              });
            }
          });
        }
      });
    },
    formatDate(date) {
      let origina_date = date.split("-");
      return `${origina_date[2]}-${origina_date[1]}-${origina_date[0]}`;
    },
  },
};
</script>

<style scoped>
</style>

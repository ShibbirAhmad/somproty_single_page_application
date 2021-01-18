<template>
  <div>
    <div class="content-wrapper">
      <section style="margin-bottom: 20px" class="content-header">
        <ol class="breadcrumb">
          <li>
            <a href="#"><i class="fa fa-dashboard"></i>Dashboard</a>
          </li>
          <li class="active">subscriber</li>
        </ol>
      </section>
      <section class="content">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-10 col-lg-10 offset-1">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">subscriber table</h3>
                  <div style="margin-top: 5px" class="row">
                    <div class="col-md-2">
                      <select class="form-control" v-model="item">
                        <option value="10">10</option>
                        <option value="10">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                        <option value="50">50</option>
                      </select>
                    </div>
                    <div class="col-md-2">
                      <button @click="exportSubscribers" class="btn btn-success"> <i class="fa fa-download"></i> Export subscribers</button>
                    </div>
                    <div class="col-md-3"></div>
                    <div class="col-md-4">
                      <form action="">
                        <input
                          type="text"
                          @keyup="searchSubscriber"
                          v-model="search"
                          placeholder="subscriber email  "
                          class="form-control"
                          id=""
                        />
                      </form>
                    </div>
                    <div class="col-md-1">
                      <button
                        style="margin-left: -23px"
                        type="submit"
                        class="btn btn-success"
                      >
                        search
                      </button>
                    </div>
                  </div>
                </div>
                <div class="box-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <h1 class="text-center" v-if="loading">
                        <i class="fa fa-spin fa-spinner"></i>
                      </h1>
                      <tr
                        v-for="(subscriber, index) in subscribers.data"
                        v-bind:key="index"
                      >
                        <td scope="row">{{ index + 1 }}</td>
                        <td>{{ subscriber.email }}</td>
                        <td>
                          <button
                            @click="trashSubscriber(subscriber.id, index)"
                            class="btn btn-danger"
                          >
                            <i class="fa fa-trash"></i>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="box-footer">
                  <div class="row">
                    <div class="col-lg-6">
                      <pagination
                        :data="subscribers"
                        :limit="3"
                        @pagination-change-page="subscriberList"
                      >
                      </pagination>
                    </div>
                    <div
                      class="col-lg-6 mt-1"
                      style="margin-top: 25px; text-align: right"
                    >
                      <p>
                        Showing <strong>{{ subscribers.from }}</strong> to
                        <strong>{{ subscribers.to }}</strong> of total
                        <strong>{{ subscribers.total }}</strong> entries
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
      this.subscriberList();
    }, 500);
    // this.getResults();
  },
  data() {
    return {
      subscribers: {},
      loading: true,
      item: "",
      search: "",
    };
  },
  methods: {
    searchSubscriber() {
      if (this.search.length >= 2) {
        axios.get("/api/subscriber/search/" + this.search).then((resp) => {
          console.log(resp);
          if (resp.data.status == "OK") {
            this.subscribers = resp.data.subscribers;
          }
        });
      } else {
        this.subscriberList();
      }
    },
    subscriberList(page = 1) {
      axios
        .get("/api/display/subscribers?page=" + page, {
          params: {
            item: this.item,
          },
        })
        .then((resp) => {
          console.log(resp);
          if (resp.data.status == "OK") {
            this.subscribers = resp.data.subscribers;
            this.loading = false;
          }
        });
    },
 
    trashSubscriber(subscriber_id, index) {
      Swal.fire({
        title: "Are you sure?",
        text: "Delete this slider!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes!",
      }).then((result) => {
        if (result.value) {
          axios.get("/api/subscriber/remove/" + subscriber_id).then((resp) => {
            this.subscriberList();
            this.$toasted.show(resp.data.message, {
              type: "alert",
              duration: 3000,
              position: "top-center",
            });
          });
        }
      });
    },
      
      exportSubscribers(){
      window.open('/api/subscriber/exports');
    },

  },

};
</script>

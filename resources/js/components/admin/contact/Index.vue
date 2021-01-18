<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section style="margin-bottom: 20px" class="content-header">
        <ol class="breadcrumb">
          <li>
            <a href="#"><i class="fa fa-dashboard"></i>Dashboard</a>
          </li>
          <li class="active">contact</li>
        </ol>
      </section>
      <section class="content">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-10 col-lg-10 offset-1">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">contact table</h3>
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
                    <div class="col-md-5"></div>
                    <div class="col-md-4">
                      <form action="">
                        <input
                          type="text"
                          @keyup="searchContact"
                          v-model="search"
                          placeholder="contact email  "
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
                  <table class="table text-center">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Message</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <h1 class="text-center" v-if="loading">
                        <i class="fa fa-spin fa-spinner"></i>
                      </h1>
                      <tr
                        v-for="(contact, index) in contacts.data"
                        v-bind:key="index"
                      >
                        <td scope="row">{{ index + 1 }}</td>
                        <td scope="row">{{ contact.name }}</td>
                        <td cope="row">{{ contact.email }}</td>
                        <td cope="row">
                          <textarea class="form-control" rows="3">
                           {{ contact.message }} </textarea
                          >
                        </td>
                        <td cope="row">
                          <router-link
                            :to="{
                              name: 'contact_message_reply',
                              params: { id: contact.id },
                            }"
                            style="margin-top: 20px"
                            class="btn btn-success"
                          >
                            <i class="fa fa-reply-all"> </i
                          ></router-link>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="box-footer">
                  <div class="row">
                    <div class="col-lg-6">
                      <pagination
                        :data="contacts"
                        :limit="3"
                        @pagination-change-page="contactList"
                      >
                      </pagination>
                    </div>
                    <div
                      class="col-lg-6 mt-1"
                      style="margin-top: 25px; text-align: right"
                    >
                      <p>
                        Showing <strong>{{ contacts.from }}</strong> to
                        <strong>{{ contacts.to }}</strong> of total
                        <strong>{{ contacts.total }}</strong> entries
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
      this.contactList();
    }, 500);
    // this.getResults();
  },
  data() {
    return {
      contacts: {},
      loading: true,
      item: "10",
      search: "",
    };
  },
  methods: {
     searchContact(page = 1) {
      if (this.search.length >= 2) {
        axios.get("api/contacted/customer/search/" + this.search + "?page=" + page)
        .then((resp) => {
          console.log(resp);
          if (resp.data.status == "OK") {
            this.contacts = resp.data.contacts;
          }
        });
      } else {
        this.contactList();
      }
    },
    contactList(page = 1) {
      axios
        .get("/api/display/contacts?page=" + page, {
          params: {
            item: this.item,
          },
        })
        .then((resp) => {
          console.log(resp);
          if (resp.data.status == "OK") {
            this.contacts = resp.data.contacts;
            this.loading = false;
          }
        });
    },
    trashContact(contact_id, index) {
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
          axios.get("/api/contact/remove/" + contact_id).then((resp) => {
            this.contactList();
            this.$toasted.show(resp.data.message, {
              type: "alert",
              duration: 3000,
              position: "top-center",
            });
          });
        }
      });
    },
  },
};
</script>

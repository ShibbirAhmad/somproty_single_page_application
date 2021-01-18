<template>
  <div class="wrapper-wide">
    <loading
      :active.sync="isLoading"
      :can-cancel="true"
      :is-full-page="fullPage"
    ></loading>

    <frontend-header></frontend-header>
    <div id="container">
      <div class="container">
        <div class="row">
          <!--Middle Part Start-->
          <div id="content" class="col-sm-12">
            <div class="row">
              <div class="col lg-12 col-md-12 col-sm-12 text-center">
                <h2 class="heading"><span>CONTACT US</span></h2>
              </div>
            </div>
            <div class="row contact_row">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="row">
                  <div class="col-md-2 col-sm-2"></div>
                  <div class="col-md-8 col-sm-12 bg-white shadow">
                    <div class="address_container">
                      <p>
                        <i class="fa fa-map-marker"></i>Office: House:02, Lane:11,Block:A, Banaroshi Polli, section-10,
                          Mirpur,Dhaka.
                      </p>
                      <p><i class="fa fa-phone"></i>09636 203040</p>
                      <p>
                        <i class="fa fa-envelope"></i>Email: support@mohasagor.com
                      </p>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-4"></div>
                </div>
                <br />
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="row">
                  <div class="col-lg-2 col-md-2 col-sm-2"></div>

                  <div class="col-lg-8 col-md-8 col-sm-10 box shadow bg-white">
                    <div class="text-center">
                      <h5 class="heading">
                        send us message, our customer service will be response.
                      </h5>
                    </div>
                    <form @submit.prevent="sendMessage()" method="post">
                      <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" type="text" v-model="name" />
                      </div>

                      <div class="form-group">
                        <label for="name">Email</label>
                        <input class="form-control" type="emial" v-model="email" />
                      </div>

                      <div class="form-group">
                        <label for="name">Message</label>
                        <textarea
                          v-model="message"
                          class="form-control"
                          rows="5"
                        ></textarea>
                      </div>

                      <input type="submit" class="btn btn-lg submit_style" value="send" />
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--Middle Part End -->
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
    setTimeout(() => {
      this.isLoading = false;
    }, 1000);
  },

  data() {
    return {
      isLoading: true,
      fullPage: true,
      name: "",
      email: "",
      message: "",
    };
  },
  methods: {
    sendMessage() {
      axios
        .post("/_public/customer/contact", {
          name: this.name,
          email: this.email,
          message: this.message,
        })
        .then((resp) => {
          if (resp.data.success == "OK") {
            Swal.fire({
              type: "success",
              text: "Thanks for your message, we will reply as soon as possible",
              confirm: true,
              duration: 4000,
              position: "top-center",
            });
            this.name = "";
            this.email = "";
            this.message = "";
          } else {
            Swal.fire({
              type: "error",
              text: "something went wrong. please, try again ",
              position: "top-center",
            });
          }
        });
    },
  },
  components: {
    Loading,
  },
};
</script>

<style scoped>
.submit_style {
  margin-bottom: 20px;
  width: 80px;
  background: #ff4d03;
  border: dashed 1px;
  color: #fff;
  font-size: 16px;
}

.address_container {
  margin-top: 30px;
  margin-bottom: 50px;
}

@media screen and (max-width: 350px) {
  .address_container {
    margin-top: 30px;
    margin-left: 10px;
    margin-right: 10px;
    margin-bottom: 50px;
  }
  .contact_row {
    margin-top: -15px;
  }
  p {
    position: relative;
    font-size: 13px;
    line-height: 15px;
  }
  .box {
    margin: 10px;
  }
}
.address_container {
    padding: 10px;
}

.address_container i {padding-right: 15px;color: #ff4d03;}
</style>

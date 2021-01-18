<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <router-link :to="{ name: 'team_member' }" class="btn btn-primary"
            ><i class="fa fa-arrow-right"></i
          ></router-link>
        </h1>
        <ol class="breadcrumb">
          <li>
            <a href="#"><i class="fa fa-dashboard"></i>Dashboard</a>
          </li>
          <li class="active">member</li>
        </ol>
      </section>

      <section class="content">
        <div class="container">
          <div class="row">
            <div class="member-info">
              <img
                :src="
                  member.avator
                    ? basePath + member.avator
                    : basePath + 'images/static/user2-160x160.jpg'
                "
                class="member-image"
                :alt="member.name"
              />
              <h3 style="line-height: 0">{{ member.name }}</h3>
              <h6>{{ member.designation }}</h6>
              <h4>Phone:{{ member.phone }}</h4>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-5">
              <h1 class="text-center" v-if="loading">
                <i class="fa fa-spin fa-spinner"></i>
              </h1>
              <div class="box box-primary" v-else>
                <div class="box-header with-border"></div>

                <div class="box-body">
                  <table
                    class="table text-center"
                    v-if="Object.keys(salaryList).length"
                  >
                    <thead>
                      <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(salary, index) in salaryList" :key="index">
                        <td>
                          {{ salary.date }}
                        </td>
                        <td>{{ salary.amount }}</td>
                      </tr>
                      <tr>
                        <td></td>
                        <td>
                          <b>= {{ total() }}</b>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <div v-else>
                    <h4 class="text-uppercase text-center">
                      <strong>
                        No Slalary preview AGAINST {{ member.name }}</strong
                      >
                    </h4>
                    <router-link
                      :to="{ name: 'team_member' }"
                      class="btn btn-primary btn-block"
                      ><i class="fa fa-arrow-right"></i
                    ></router-link>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="box">
                <div class="box-header with-border"></div>

                <div class="box-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Month</th>
                        <th>Amount</th>
                        <th>Comment</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="(paid_salary, index) in paid_salaryies"
                        :key="index"
                      >
                        <td>{{ index + 1 }}</td>
                        <td>{{ paid_salary.date }}</td>
                        <td>{{ paid_salary.amount }}</td>
                        <td>{{ paid_salary.comment }}</td>
                      </tr>
                      <tr>
                        <td colspan="2"></td>
                        <td>
                          <strong> = {{totalSalary()}}</strong>
                        </td>
                      </tr>
                    </tbody>
                  </table>

                  <button  style="margin-top:10px;" @click="showModal" class="btn btn-danger">
                    Add Salary
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <modal name="example" :width="400" :height="300">
      <div class="card">
        <div class="card-body">
          <div class="form-group">
            <label>Date</label>
            <date-picker
              autocomplete="off"
              v-model="salary_date"
              :config="options"
            ></date-picker>
          </div>
          <div class="form-group">
            <label>Amount</label>
            <input type="text" v-model="salary_amount" class="form-control" />
          </div>
          <div class="form-group">
            <label>Comment</label>
            <input type="text" v-model="salary_comment" class="form-control" />
          </div>

          <button class="btn btn-success btn-block" @click="emloyeeSalaryPaid">
            Submit
          </button>
        </div>
      </div>
    </modal>
  </div>
</template>




<script>
export default {
  mounted() {
    console.log("mounted member");

    this.getMemberSalary();
  },

  data() {
    return {
      loading: true,
      member: "",
      salaryList: "",
      basePath: this.$store.getters.image_base_link,
      options: {
        format: "YYYY-MM-DD",
        useCurrent: false,
      },
      salary_date: "",
      salary_amount: "",
      salary_comment: "",
      paid_salaryies: "",
    };
  },

  methods: {
    getMemberSalary() {
      axios
        .get("/api/member/salary/list/" + this.$route.params.id)
        .then((resp) => {
          console.log(resp);
          this.member = resp.data.member;
          this.salaryList = resp.data.salary;
          this.paid_salaryies = resp.data.paid_salary;
          this.loading = false;
        })
        .catch((e) => {
          console.log(e);
        });
    },
    dateFiltaring(date) {
      console.log(date);
      const d = new Date(date);
      const year = new Intl.DateTimeFormat("en", { year: "numeric" }).format(d);
      const mounth = new Intl.DateTimeFormat("en", { month: "long" }).format(d);
      const day = new Intl.DateTimeFormat("en", { d: "2-digit" }).format(d);
      let outpuDate = `${day}-${mounth}-${year}`;
      return outpuDate;
    },
    total() {
      let total = 0;
      this.salaryList.forEach((element) => {
        total += parseInt(element.amount);
      });
      return total;
    },

    showModal() {
      this.$modal.show("example");
    },
    emloyeeSalaryPaid() {
      if (this.salary_date.length < 1) {
        alert("Please Check Date Filed");
        return;
      }
      if (this.salary_amount.length < 1) {
        alert("Amount filed is empty");
        return;
      }
      if (this.salary_amount < 1) {
        alert("Amount Can not be smaller 1");
        return;
      }

      axios
        .get("/api/employee/salary/paid/", {
          params: {
            date: this.salary_date,
            amount: this.salary_amount,
            employee_id: this.member.id,
            comment: this.salary_comment,
          },
        })
        .then((resp) => {
          if (resp.data) {
            this.$toasted.show(resp.data, {
              type: "warining",
              position: "top-center",
              duration: 4000,
            });
            this.getMemberSalary();
            this.$modal.hide("example");
          }
        })
        .catch((e) => {
          console.log(e);
        });
    },
    totalSalary(){
      let total=0;
      this.paid_salaryies.forEach(element=>{
        total+=parseInt(element.amount)
      })
      return total;

    }
  },
};
</script>



<style scoped>
.dropbtn {
  width: 100% !important;
  margin-bottom: 5px !important;
}
.dropbtn-active {
  display: block !important;
}
.dropdown-action {
  display: none;
  width: 90px;
  position: absolute;
}

img.member-image {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  border: 3px solid #222d32;
  padding: 3px;
  line-height: 0;
}
.member-info {
  text-align: center;
}
</style>

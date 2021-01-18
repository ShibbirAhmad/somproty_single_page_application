<template>
  <div>
    <admin-main></admin-main>
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <router-link  :to="{name:'teamSalary',params:{id:member.id}}" class="btn btn-primary"
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
            <div class="col-lg-10">
              <h1 class="text-center" v-if="loading">
                        <i class="fa fa-spin fa-spinner"></i>
               </h1>
               <div class="box box-primary" v-else>
                <div class="box-header with-border"></div>
                          <div class="row">
                            <div class="member-info">
                               <img :src="member.avator ? basePath+member.avator : basePath + 'images/static/user2-160x160.jpg' "
                                  class="member-image"
                                  :alt="member.name" />
                                  <h3 style="line-height:0;">{{member.name}}</h3>
                                  <h6>{{member.designation}}</h6>
                                  <h4>Phone:{{member.phone}}</h4>
                            </div>
                            
               </div>
                <div class="box-body">
       
                  <table class="table text-center">
                    <thead>
                      <tr>
                         <th scope="col">Date</th>
                        <th scope="col">Amount</th>
                         <th scope="col">Paid</th>

                       
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(salary,index) in salaryList" :key="index">
                        <td>
                          <router-link to="name"></router-link>
                          {{dateFiltaring(salary.date)}}
                          </td>
                        <td>{{salary.amount}}</td>
                        <td>{{salary.paid}}</td>
                        
                      </tr>
                      <tr>
                        <td colspan="1"></td>
                        <td><strong> = {{totalAmount()}}</strong></td>
                      </tr>
                      </tbody>
                 
                     
                  </table>
                    
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
  mounted() {
    console.log("mounted member");
   
    this.getMemberSalary();
  },

  data() {
    return {
      loading: true,
      member:'',
      salaryList:'',
     basePath: this.$store.getters.image_base_link
    };
  },
   
  methods: {
    
    getMemberSalary(){
      axios.get('/api/member/salary/list/'+this.$route.params.id+'/'+this.$route.params.month)
          .then(resp=>{
            console.log(resp);
            this.member=resp.data.member;
            this.salaryList=resp.data.salary;
            this.loading=false
          })
          .catch(e=>{
            console.log(e);
          })
    },
    totalAmount(){
       let total=0;
       this.salaryList.forEach(element => total+=parseInt(element.amount));
      return total; 
    },
    dateFiltaring(date){

      const d = new Date(date);
      const year = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(d);
      const mounth = new Intl.DateTimeFormat('en', { month: 'short' }).format(d);
       const day = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d);
      let outpuDate=`${day}-${mounth}-${year}`;

      return outpuDate;
    //  return day;
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

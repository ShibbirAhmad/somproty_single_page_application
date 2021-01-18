<script>
  export default {
    methods: {
      $can(permissionName) {
       
        if(Permissions.indexOf(permissionName) <0){
           return false;
        }else{
         
           return true;
         
        }
      },
    },
    
  };
</script>
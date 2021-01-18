<template>
    <div>
        <button @click="exportCsv" class="btn btn-success">csv</button>
     </div>
</template>
<script>
export default {
    props:{
        table_id:{
            type:String,
           required: true
        }
    },
    methods:{
        exportCsv(){
            let table=document.getElementById(this.table_id);
           console.log(table)
           console.log(typeof table)

           for (var r = 0, n = table.rows.length; r < n; r++) {
        for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
            console.log(table.rows[r].cells[c].innerHTML);
        }
    }
              
    //  console.log(data);
      //link.click();
        }
    }
}
</script>
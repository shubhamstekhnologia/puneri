
$(document).ready(function(){
$("#data-table-2").DataTable({
    scrollX:true,
    paging:false
   
    
});
$("#data-table").DataTable({
    responsive:true
   
});
$("#data-table-4").DataTable({
    scrollX:true,
    paging:false,
    searching:false,
     "bAutoWidth": false,
    "bInfo" : false
    
});
})
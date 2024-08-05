function export_attachment(menu,extension){
    var startDate_   = $("#datepicker").data('daterangepicker').startDate.format('YYYY-MM-DD HH:mm:00');
       var endDate_     = $("#datepicker").data('daterangepicker').endDate.format('YYYY-MM-DD HH:mm:00');
       var module_      = $("#module").val();
       var status_      = $("#status").val();
       var option       = $("#option").val() ?? "";
       var data ={
                start:startDate_,
                end:endDate_,
                module:module_,
                status:status_,
                option:option
        };
        var url = menu+"/export/"+extension+"?" + $.param(data);
        window.location = url;
}
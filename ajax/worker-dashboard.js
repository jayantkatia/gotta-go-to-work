$(document).ready(function () {
    // $("#rateForm").submit(function(){
    //     let url="../process/worker-dashboard-rate.php"
    //     let data=$("#rateForm").serialize();
    //     $.post(url,data,function(response,status){
    //         alert(response);
    //         $("#rateModal").modal("hide");
    //     });
    //     return false;
    // });
    $("#rateForm").submit(function () {
        let url = "../process/worker-dashboard-rate.php"
        // let data = $("#rateForm").serialize();
        var data={
            citizenUsername:$("#citizenUsername").val(),
            workerUsername:$("#workerUsername").val()
        } 

        $.post(url, data, function (response, status) {
            alert(response);
            $("#rateModal").modal("hide");
        });
        return false;
    })
    $('#rateModal').on('hidden.bs.modal', function () {
        $("#rateForm").trigger("reset");
    });
});
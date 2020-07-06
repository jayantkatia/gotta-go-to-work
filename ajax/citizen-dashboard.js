$(document).ready(function () {
    $("#postRequirementsForm").submit(function(event){
        //perform button function
        let url = "../process/citizen-dashboard-post.php";
        let data = $("#postRequirementsForm").serialize();

        $.post(url, data, function (response, status) {
            alert(response);
            $("#postRequirementsModal").modal("hide");
        });
        return false;
    });
    $('#postRequirementsModal').on('hidden.bs.modal', function () {
        $("#postRequirementsForm").trigger("reset");
    });
    

});
$(document).ready(function () {
    $("#postRequirementsForm").submit(function(event){
        //perform button function
        let url = "../process/citizen-dashboard-post.php";
        let data = $("#postRequirementsForm").serialize();
        // console.log(data);

        data=data+"&username="+$('#citizenUsername').val();
        // console.log(data);
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
$(document).ready(function () {
    $("#workerFetch").click(function () {
        let username = $('#workerUsername').val();
        let url = "../process/worker-profile-username.php?username=" + username;
        console.log(url);
        $.getJSON(url, function (response) {
            console.log(response);
            if (response.length != 0) {
                let ref = ["workerContact", "workerName", "workerCity", "workerState", "workerAddress", "workerEmail", "workerFirm", "workerExp", "workerSpec", "workerExpText", "workerCategory"];
                let val = ["contact", "name", "city", "state", "address", "email", "firm", "exp", "spec", "exptext", "category"];
                for (let i = 0; i < ref.length; i++) {
                    if (response[`${val[i]}`])
                        $(`#${ref[i]}`).val(response[`${val[i]}`]);
                }
                if (response["ppic"]) {
                    $("#prev").attr("src", "../uploads/workers/" + response["ppic"]);
                    console.log(response["ppic"])
                }
                if (response["apic"]) {
                    $("#prevAadhar").attr("src", "../uploads/workers/" + response["apic"]);
                }
            }
        });
    });
});
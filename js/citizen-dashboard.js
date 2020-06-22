let userProfileCard=document.getElementById("userProfileCard");
userProfileCard.onclick=()=>{
    window.location.href="../views/citizen-profile.php";
};
userProfileCard.style.cursor="pointer";

let modalCard=document.getElementById("modalCard");
modalCard.onclick=()=>{
    $("#modal").modal('show');
};
modalCard.style.cursor="pointer";
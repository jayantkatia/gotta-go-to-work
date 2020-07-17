let userProfileCard=document.getElementById("userProfileCard");
userProfileCard.onclick=()=>{
    window.location.href="../views/citizen-profile.php";
};
// userProfileCard.style.cursor="pointer";



let category=["Electrician","Plumber","Carpenter","Painter","Repairman","Internet Services","Computer Technician","Manager","Personal Trainer","Home Barber services"];
let categoryPostRequirements=document.getElementById("categoryPostRequirements");

fillSelect(category,categoryPostRequirements);
function fillSelect(ary,ref){
    for(let i=0;i<ary.length;i++){
        // let text = document.createTextNode(ary[i]);
        let option = document.createElement('option');
        // option.appendChild(text);
        option.value = ary[i];
        ref.appendChild(option);
    }
}
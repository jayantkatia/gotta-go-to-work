// let states = ["Andhra Pradesh",
//     "Arunachal Pradesh",
//     "Assam",
//     "Bihar",
//     "Chhattisgarh",
//     "Goa",
//     "Gujarat",
//     "Haryana",
//     "Himachal Pradesh",
//     "Jammu and Kashmir",
//     "Jharkhand",
//     "Karnataka",
//     "Kerala",
//     "Madhya Pradesh",
//     "Maharashtra",
//     "Manipur",
//     "Meghalaya",
//     "Mizoram",
//     "Nagaland",
//     "Odisha",
//     "Punjab",
//     "Rajasthan",
//     "Sikkim",
//     "Tamil Nadu",
//     "Telangana",
//     "Tripura",
//     "Uttarakhand",
//     "Uttar Pradesh",
//     "West Bengal",
//     "Andaman and Nicobar Islands",
//     "Chandigarh",
//     "Dadra and Nagar Haveli",
//     "Daman and Diu",
//     "Delhi",
//     "Lakshadweep",
//     "Puducherry"]
// let workerState = document.getElementById("workerState");

let exp=[0,1,2,3,4,5,6,7,8,9,10,11];
let workerExp=document.getElementById("workerExp");

let category=["Electrician","Plumber","Carpenter","Painter","Repairman","Internet Services","Computer Technician","Manager","Personal Trainer","Home Barber services"];
let workerCategory=document.getElementById("workerCategory");

// fillSelect(states,workerState);
fillSelect(exp,workerExp);
fillSelect(category,workerCategory);

function fillSelect(ary,ref){
    for(let i=0;i<ary.length;i++){
        let text = document.createTextNode(ary[i]);
        let option = document.createElement('option');
        option.appendChild(text);
        option.value = ary[i];
        ref.appendChild(option);
    }
}
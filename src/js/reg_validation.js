// Getting data from all feilds 
const first_name = document.getElementById("first_name");
const last_name = document.getElementById("last_name");
const user_name = document.getElementById("user_name");
const gender = document.getElementsByClassName("gender");
const mobile = document.getElementById("Mobile_number");
const password = document.getElementById("user_password");
const address = document.getElementById("user_address");
const dob = document.getElementById("user_date_of_birth");


var xml = new XMLHttpRequest();

// File handling request

var url = ""
const regForm = document.getElementById("reg_form");
const submit = document.getElementById("reg_user");
const popoverContainers = document.querySelectorAll('.popover-container');
let count = 0;
const messages = {
    0 : "invalid Email",
    1 : "Password Should contain A a #?!@$%^&*- 1-9 8 to 20 character",
    2 : "Password does not match"
}
// createAlert('success', 'warning', "Warned amigo");
let password_flag = false;
let email_flag = false;
let re_password_flag = false;
popoverContainers.forEach((container, index) => {
    const input = container.querySelector('.my-textbox');
    const popover = container.querySelector('.popover-content');
    
    input.addEventListener('keyup', () => {
        
        popover.childNodes[0].textContent = messages[index];
 
        switch(index){
            // For password
            case 1 :
                // console.log(count)

                console.log(input.value);
                if(checkPassword(input.value) === null ){
                    showPopover(popover);
                    popoverContainers[index + 1].childNodes[1].disabled = true
                    if(count > 0 && password_flag === true){
                        count --;
                        console.log(count)
                        password_flag = false;
                    }
                }
                else if(checkPassword(input.value) !== null && password_flag === false){
                    hidePopover(popover);
                    
                    popoverContainers[index + 1].childNodes[1].disabled = false
                    password_flag = true;
                    count++;
                    // console.log(count)
                }
            break;
            // For email
            case 0 :
                console.log(input.value);
                if(checkEmail(input.value) === null ){
                    showPopover(popover);
                    if(count > 0 && email_flag === true){
                        count --;
                        email_flag = false;
                    }
                    // console.log(count)
                }
                else if(checkEmail(input.value) !== null && email_flag === false){
                    hidePopover(popover);
                    email_flag = true;
                    count++;
                    console.log(count)
                }
            break;
                // For matching both password
                case 2 :
                if(input.value !== popoverContainers[index-1].childNodes[1].value ){
                    showPopover(popover);
                    console.log(count)
                    if(count > 0 && re_password_flag == true){
                        count --;
                        re_password_flag = false;
                    }
                }
                else if(input.value === popoverContainers[index-1].childNodes[1].value && re_password_flag == false){
                    hidePopover(popover);
                    re_password_flag = true;
                    count++;
                    console.log(count)
                }
            break;
        }
    });

    input.addEventListener('mouseout', () => {
        hidePopover(popover);
    });
});

function checkPassword(passwordInput){
    const regex_password = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,20}$/;
    const match = passwordInput.match(regex_password);  
    return match;      
}
// checking email
function checkEmail(inputEmail){
    const regex_email = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const match = inputEmail.match(regex_email);
    return match;
}

// Preventing form from submitting 
if(submit != null){
    submit.addEventListener("click", (e)=>{
        e.preventDefault();
        if(checkInputAgain()){
            if(checkDobName()){
                console.log('here');
                submitForm();
            }
        }
    
    })
}
// checking dob and missing feilds
function checkDobName(){
    let dobs = document.querySelector('.date').value;
    let fname = document.querySelector('.fname').value;
    let lname = document.querySelector('.lname').value;

    const msgs = {
        0 : 'Enter Date',
        1 : 'Fill First Name',
        2 : 'Fill Last Name'
    };
    const allInputs = [dobs, fname, lname];

    for(let i = 0 ; i<3 ; i++){
        if(allInputs[i] == ""){
            createAlert('warning', `Please  ${msgs[i]}`,'');
            return 0;
        }
    }
    
    const res = checkAge(dobs);
    if(res != 1){
        return 0;
    }else{
        return 1;
    }
}
function checkAge(dobs){
    const dob = new Date(dobs);
    // console.log(dob);
    // Calculate the age based on the difference between the user's date of birth and the current date
    const ageInMilliseconds = Date.now() - dob.getTime();
    const ageDate = new Date(ageInMilliseconds);
    const age = Math.abs(ageDate.getUTCFullYear() - 1970);

    if(dob.getFullYear() >= new Date().getFullYear()){
        createAlert('warning', `Please  Enter valid age`,'');
        return 0;
    }
    // Compare the age with the required minimum age (in this example, the required minimum age is 18)
    if (age < 18) {
    // User is below the required minimum age
        createAlert('warning', 'Age is less then minimum age', '');
        return 0;
    } else if(age > 100) {
    // User is above or equal to the required minimum age
        createAlert('warning', 'Age  is invalid ', '');
            return 2;
    }
    return 1;
}
// Chcking all inputs again
function checkInputAgain(){
    const password = popoverContainers[1].childNodes[1].value;
    const allChecks = [checkEmail(popoverContainers[0].childNodes[1].value), checkPassword(popoverContainers[1].childNodes[1].value), popoverContainers[2].childNodes[1].value ===  password ];
    allChecks.forEach((Element, index)=>{
        if(Element === null || Element === false){
            // displaying appropiate message

            let container = popoverContainers[index].querySelector('.popover-container');
            // container.textContent = messages[index];
            console.log(container);
            showPopover(container);
            return 0;
        }
    })
    return 1;
}
function submitForm(){
    // Checking if all inputs are valid
    if(count < 3){
        checkInputAgain();
    }
    const formData = new FormData(regForm);
    axios.post("",formData)
    // handling response
    .then(Response =>{
        let message = Response.data;
        console.log(message);
        if(message.text !== ""){
            const text = message.text;
            if(text === "missingVal"){
                createAlert('danger','Invalid Value : ','Input is Invalid please check it once again' );
            }else if(text == "userAlreadyAvailable"){
                createAlert('warning', 'NotAllowed! ', 'User is already available on given E-mail id ');
            }else{
                console.log(message);
            }
        }
        if(Response.data.url !== undefined && Response.data.url !== ""){
            window.location.href = message.url;
        }
    })
    .catch(Response =>{
        console.log(Response.error);
    })
    console.log('req_send')
}


const form = document.getElementById("reg_form");
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
        
        popover.childNodes[1].textContent = messages[index];
 
        switch(index){
            // For password
            case 1 :
                console.log(count)

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
                    console.log(count)
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
                    console.log(count)
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
                    if(count > 0 && re_password_flag === true){
                        count --;
                        re_password_flag = false;
                    }
                    console.log(count)
                }
                else if(input.value === popoverContainers[index-1].childNodes[1].value && re_password_flag === false){
                    hidePopover(popover);
                    email_flag = true;
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
submit.addEventListener("click", (e)=>{
    e.preventDefault();
    if(checkInputAgain()){
        submitForm();
    }


})
// Cheking mobile number

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
    const formData = new FormData(form);
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


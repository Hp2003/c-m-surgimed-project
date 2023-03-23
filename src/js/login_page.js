let form_login = document.getElementById('login_form');
const btn = document.querySelector('.login_user');
const popoverContainers = document.querySelector('.popover-container');

let count = 0;
let email_flag = false;
popoverContainers.addEventListener('keyup', (e)=>{
    const input = document.querySelector('.my-textbox');
    console.log(input)
    const popover = popoverContainers.querySelector('.popover-content');

    console.log('in');

    console.log(input.value);
    if(checkEmail(input.value) === null ){
        // popoverMain.style.display = 'block';
        showPopover(popover, "Enter valid email");
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
})
// Checking eamil
function checkEmail(inputEmail){
    const regex_email = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const match = inputEmail.match(regex_email);
    return match;
}
// handling login button
btn.addEventListener('click', (e)=>{
    e.preventDefault();
    if(count < 1){
        createAlert('warning', 'warning ! : ', 'Please check input!');
        return;
    }
    const formData = new FormData(form_login);

    axios.post('', formData)
    .then(Response =>{
        // console.log(Response.data.url);
        if(Response.data.text !== ""){
            if(Response.data.text == "invalidEmail"){
                createAlert('danger', 'warning ! : ', 'Please check input!');
            }else if(Response.data.text == "userNotFound"){
                createAlert('danger', 'Note ! : ', 'Email id or password is wrong! ');
            }
        }
        if(Response.data.url !== undefined && Response.data.url !== ""){
            window.location.href = Response.data.url;
        }
    })
})

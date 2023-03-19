let contactForm = document.getElementById('contactUs_form');
let submitContactBtn = document.getElementById('hcb');
const emailContact = document.getElementById('ehc');
const message = document.getElementById('mhc');

submitContactBtn.addEventListener('click', (e)=>{
    e.preventDefault();

    if(checkEmail(emailContact.value) === null ){
        createAlert('warning', 'Email', 'Please Enter Valid Email', 8000 );
        return 0;
    }
    else if(message.value == ''){
        createAlert('warning', 'Message', 'Please Provide us a message!', 8000 );
        return 0;
    }else{
        make_request();
    }

})
function checkEmail(inputEmail){
    const regex_email = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const match = inputEmail.match(regex_email);
    return match;
}

function make_request(){
    const formData = new FormData(contactForm);

    axios.post('', formData).then(Response =>{
        const message = Response.data.text;
        if(message !== "" || message !== undefined){
            if(message == "eamilSentSuccessFully"){
                createAlert('success', 'Email Sent! : ', 'Thankyou for Your Feedback! &#x1F60A;');
            }
            else if(message == "emailIsIncorrect"){
                createAlert('danger', 'Warning : ', 'Check Email Input!');
            }
            else if(message == "errorOccured"){
                createAlert('warning', 'Error! : ', 'Sorry Try Again Some Error Occured!');
            }
        }
    }).catch(error =>{
        console.log(error);
    })
    console.log('req sent');
}
// createAlert('success', 'Email Sent! : ', 'Thankyou for Your Feedback! &#x1F60A;');


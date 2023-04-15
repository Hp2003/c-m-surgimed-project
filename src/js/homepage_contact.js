let contactForm = document.getElementById('contactUs_form');
let submitContactBtn = document.getElementById('hcb');
const emailContact = document.getElementById('ehc');
const Message = document.getElementById('mhc');

submitContactBtn.addEventListener('click', (e)=>{
    e.preventDefault();
    if(checkEmail(emailContact.value) === null ){
        createAlert('warning', 'Email', 'Please Enter Valid Email', 8000 );
        return 0;
    }
    else if(Message.value == ''){
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
    formData.append('SendFeedback', true);
    axios.post('/api/send_feedback', formData).then(Response =>{
        console.log(Response)
        const Message = Response.data.text;
        if(Message !== "" || Message !== undefined){
            if(Message == "eamilSentSuccessFully"){
                createAlert('success', 'Email Sent! : ', 'Thankyou for Your Feedback! ');
            }
            else if(Message == "emailIsIncorrect"){
                createAlert('danger', 'Warning : ', 'Check Email Input!');
            }
            else if(Message == "errorOccured"){
                createAlert('warning', 'Error! : ', 'Sorry Try Again Some Error Occured!');
            }
        }
    }).catch(error =>{
        console.log(error);
    })
    console.log('req sent');
}
// createAlert('success', 'Email Sent! : ', 'Thankyou for Your Feedback!;');


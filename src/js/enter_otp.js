console.log('hello world');
if(localStorage.getItem('otp message') == 'success'){
    createAlert('success', 'otp sent success fully','');
    localStorage.removeItem('otp message')
}else if(localStorage.getItem('otp message') == 'failed'){
    createAlert('warning', 'Failed sending otp','');
    localStorage.removeItem('otp message')
}
let form = document.getElementById('otp_form');
let btn = document.getElementById('otp_btn');
const otp = document.getElementById('OTP_input');

btn.addEventListener('click', (e)=>{
    e.preventDefault();
    const regex = /^(\d{6}|\d{3}-\d{3})$/;
    
    if(regex.test(otp.value)){
        // matching otp
        varifyOtp();
    }else{
        createAlert('warning', 'Note : ', 'wrong OTP Input', 10000);
    }
})
// console.log(form);
function varifyOtp(){
    // making request
    const formData = new FormData(form);
    axios.post("",formData)
    .then(Response =>{
        console.log('in');
        console.log(Response.data)
        // console.log(Response.data)
        if(Response.data.text !== ""){
            if(Response.data.text === "otpDidNotMatch"){
                createAlert('warning', 'Note! :', 'Wrong Otp!!',10000);
            }
            else if(Response.data.text === "InvalidInput"){
                createAlert('danger', 'Warning ! :', ' Invalid Input!!',10000);
            }
        }
        if(Response.data.url !== undefined && Response.data.url !== ""){
            window.location.href = Response.data.url;
        }
 

    })
    .catch(err =>{
        console.log(err.error);
    })
}
function sendOtpAgain(e){
    e.preventDefault();
    axios.post('/api/send_otp_again').then(Response =>{
        if(Response.data.text === 'Otp sent success fully'){
            localStorage.setItem('otp message', 'success');
            window.location.href = window.location;
        }else{
            localStorage.setItem('otp message', 'failed');
            window.location.href = window.location;
        }
        // console.log(Response.data)
    })
}
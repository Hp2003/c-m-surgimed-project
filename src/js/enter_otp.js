console.log('hello world');

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
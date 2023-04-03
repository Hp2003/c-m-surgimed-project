document.querySelector('#pass_btn').addEventListener('click', (e)=>{
    e.preventDefault();
    let formData = new FormData(document.querySelector('#forgotPassword'));
    axios.post('/forgot_password', formData).then(Response=>{
        if(Response.data.text == 3){
            createAlert('warning', 'Please enter valid email', '');
        }
        if(Response.data.text == false){
            createAlert('warning', 'User Not Available', '');
        }
        if(Response.data.url != ""){
            window.location.href = Response.data.url;
        }
        console.log(Response);
    })
})
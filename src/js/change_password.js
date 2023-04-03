document.querySelector('#new_pass').addEventListener('click', (e)=>{
    e.preventDefault();
    let pass1 = document.querySelector('.Password1').value;

    let pass2 = document.querySelector('.Password2').value;

    const regex_password = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,20}$/;
    const match = pass1.match(regex_password);  
    console.log(match)
    if(match == null){
        createAlert('warning','Password should contain <b>#?!@$%^& A a 1-10 Max 20 and min 8 characters</b>', '');
        return 0;
    }
    if(pass1 !== pass2){
        createAlert('warning','Passwords did not match', '');
        return 0;
    }
    const formData = new FormData(document.querySelector('#change_passwrod'));

    axios.post('/change_password', formData).then(Response =>{
        if(Response.data.url != undefined && Response.data.url != ""){
            window.location.href = Response.data.url;
        }
    })
})
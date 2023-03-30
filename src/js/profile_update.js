// console.log("hello world");

const psf = [...document.getElementById('profile_form')];
let pdob = document.querySelector('#pdob');
const psfOriginal = document.getElementById('profile_form');
let psb = document.getElementById('psb');
psf.shift();

psb.addEventListener('click', (e)=>{
    // const newFormProfile = 
    e.preventDefault();
    let formDataProfile = new FormData();

    let isRadioChecked = false;
    // checking if radio button is checked
    psf.forEach(Element => {
        if(Element.name === "flexRadioDefault" && Element.checked && isRadioChecked == false) {
            formDataProfile.append(Element.name, Element.value);
            isRadioChecked = true;
        } else if(Element.name !== "flexRadioDefault" ){
            formDataProfile.append(Element.name, Element.value);
        }
    });
    if(isRadioChecked == false){
        createAlert('warning', 'note !', 'Please check radio button!');
        return;
    }

    
    const entries = Array.from(formDataProfile.entries());
    // console.log(formDataProfile['Dob']);

    
    entries.forEach((entry, index) => {
        const [key, value] = entry;
        // console.log(key);
        if (value == '') {
            if(!key == 'flexRadioDefault'){
                createAlert('warning', 'Missing value! : ', `Please provide us ${psf[index].name}`);
                return;
            }
        }
      });
      if(!checkAge(pdob.value) ){
        console.log('in')
        return 0;
    }
    //   formDataProfile.forEach((Element, Index) =>{
    //     console.log(Index, Element);
    //   })
    // console.log(formDataProfile);
    // console.log(formDataProfile.get("MobileNumber"))
      if(!formDataProfile.get("MobileNumber").match(/^(?:\+\d{1,3}[- ]?)?\d{10}$/)){
        createAlert('warning', 'Wrong value! : ', `Please Enter Valid Mobile Number`);
            return;
      }
      if(!formDataProfile.get('Email').match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)){
        createAlert('warning', 'Wrong value! : ', `Please Enter Valid Email`);
            return;
      }
      if(!formDataProfile.get("Dob").match(/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/)){
        createAlert('warning', 'Wrong value! : ', `Please Enter Valid Email`);
            return;
      }
      
    // console.log(formDataProfile);
      
    updateUserProfile(formDataProfile);
})


function updateUserProfile(formDataProfile){
    
    // console.log(psf);
    // Getting form data
    const fileInput = psfOriginal.querySelector('input[type="file"]');
    const file = fileInput.files[0];
    // console.log(fileInput)
    if(fileInput &&  fileInput.files.length > 0){
        const fileSizeMB = fileInput.files[0].size / 1024 / 1024;
        // Checking file size
        if (fileSizeMB > 5) {
            createAlert('warning', 'Oops! :', 'Please select small image', 10000);
        } else {
            formDataProfile.append('UserImg', file);
        }
    }
if(window.confirm('do you really want to make changes')){
    console.log('in');
    axios.post('', formDataProfile).then(Response =>{
       
        if(Response.data.text != ""){
            const message = Response.data.text;
            if(message == "Updated"){
                createAlert('success', 'Success! : ', 'Profile Updated!');
            }
            // console.log(message)
        }
        console.log(Response.data)
        
    })
}
    // console.log('here');

}
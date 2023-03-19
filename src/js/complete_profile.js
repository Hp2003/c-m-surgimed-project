var input = document.querySelector('#profile-image');
let container = document.querySelector('.upload-outer');
var preview = document.querySelector('#preview-image');
let text = document.querySelector('.custom-file-upload');
const form = document.getElementById('completeProfile');


function handleFileSelect(file) {
    if (!file.type.match('image.*')) {
        createAlert('warning', 'Warning! :', 'Please select Image file .png .jpeg etc...!', 7000);
        return;
    }
    var reader = new FileReader();
    reader.onload = function(event) {
        text.style.background = "transparent";
        text.style.color = "transparent";
        preview.src = event.target.result;
        preview.style.display = 'block';
    };
    reader.readAsDataURL(file);
}

container.addEventListener('dragenter', function(event) {
  event.preventDefault();
  container.classList.add('dragover');
});

container.addEventListener('dragover', function(event) {
  event.preventDefault();
});

container.addEventListener('dragleave', function(event) {
  container.classList.remove('dragover');
});

container.addEventListener('drop', function(event) {
  event.preventDefault();
  container.classList.remove('dragover');
  var file = event.dataTransfer.files[0];
  handleFileSelect(file);
});

input.addEventListener('change', function(event) {
    var file = event.target.files[0];
    handleFileSelect(file);
});

// Checking phone number
function checkNumber(number){
  const phoneNumberRegex = /^\d{10,15}$/;
  return phoneNumberRegex.test(number)
}
// handling event on submit button
let completeProfile = document.querySelector('.create_profile_btn')
if(completeProfile !== null){
  completeProfile.addEventListener('click',(e)=>{
    e.preventDefault();
    const number = document.querySelector('.mobile').value;
  
    // checking phone number
  if(!checkNumber(number)){
    createAlert("warning", 'Note! :', 'Please Enter valid mobile number'  );
    
    return 0;
  }
})


// checking mobile number
let Uname = document.querySelector('.Uname').value.trim() ;

if( Uname == "" ){
  createAlert("warning", 'Note! :', 'Please Enter valid user name !'  );
  throw new error('error');
}
const fileInput = form.querySelector('input[type="file"]');
const formData = new FormData(form);
const file = fileInput.files[0];


// checking file if it's there
if(fileInput &&  fileInput.files.length > 0){
  const fileSizeMB = fileInput.files[0].size / 1024 / 1024;
  // Checking file size
  if (fileSizeMB > 5) {
      createAlert('warning', 'Oops! :', 'Please select small image', 10000);
  } else {
      formData.append('UserImg', file);
    }
  }
  // making request to server
  axios.post('/complete_profile', formData)
  .then(response => {
    if(response.data.text !== ""){
      if(response.data.text == "invalidMobile"){
        createAlert('danger', 'Warning! : ', 'Mobile number is invalid!');
      }else if(response.data.text == 'invalidUserName'){
        createAlert('danger', 'Warning! : ', 'Enter a valid user name..!!');
      }
    }
    // console.log(response.data.url);
    if(response.data.url !== undefined && response.data.url !== ""){
      window.location.href = response.data.url;
    }
  }).catch(error =>{
    console.log(error);
  })
  
}



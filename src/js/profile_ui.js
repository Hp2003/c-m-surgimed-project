let allTextBoxes = document.querySelectorAll('.main-text:not(.disabled)' );
console.log(allTextBoxes);
let allButtons = document.querySelectorAll('.enable_me');

function createClickListener(index) {
    console.log(index);  
    return function(){
        if(allTextBoxes[index].disabled === true){
            allTextBoxes[index].disabled = false;
            allTextBoxes[index].style.borderColor = "yellow";
            allTextBoxes[index].focus();
            const length = allTextBoxes[index].value.length;

            allTextBoxes[index].setSelectionRange(length, length);
        }else{
            allTextBoxes[index].disabled = true;
            allTextBoxes[index].style.borderColor = "white";
        }
    }
}

allButtons.forEach((element,index)=>{
    const listener = createClickListener(index );

    element.addEventListener('click', listener);
    console.log(element);
})
// let input = document.getElementById('Female').checked;
// console.log(input);

let profileForm = document.getElementById('profile_form');
let allInputsProfileForm = profileForm.querySelectorAll('.main-text');

// allInputsProfileForm.forEach()
function addData(data){
    const keys = Object.keys(data)
    // console.log(data);
    // console.log(keys[0].trim() == allInputsProfileForm[0].value.trim());

    const dob = document.getElementById('pdob');
    const formattedDob = moment(data.Dob).format('YYYY-MM-DD');
    let db = dob.value = formattedDob;
    
    allInputsProfileForm.forEach(element => {
        if(keys.includes(element.value)){
            element.value = data[element.value];
        }
    });


    // console.log(db);

    let genButton = document.querySelectorAll(".transp-button");
    genButton.forEach(element => {
        if(element.value == data.Gender){
            element.checked = true;
        }
    });

    getImage();

}
async function getData(){
    try {
        const res = await axios.post('/api/userdata', {
          headers: {
            'Accept': 'application/json'
          }
        });
        const data1 = res.data.userData;
        return data1;
      } catch (error) {
        console.log(error);
      }
}
function getImage(){
    let formData = new FormData();
    // formData.append('path', path);
    axios.post('/api/image',formData,{
        responseType: 'blob'
      })
      .then(response => {
          const imageData = new Blob([response.data], {type: response.headers['content-type']}); 
          const imageUrl = URL.createObjectURL(imageData);
          let img = document.getElementById('preview-image')
          img.src = imageUrl;
        //   console.log(imageUrl);
    })
    .catch(error => {
        console.log(error);
    })
      
}
getData().then(data=>{
    addData(data);
})
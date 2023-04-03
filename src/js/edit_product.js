// console.log(ProId);
function editProduct(event){
    event.preventDefault();
    let form = document.querySelector('#editProduct');
    let formData = new FormData(form);
    formData.append('product_id', ProId);
    
    if(checkInputEditPro(formData)){
      console.log('in check input')
        if(checkImgs()){
            // appending images to form
            const fileInputs = document.querySelectorAll('.pro-img');
            for (let i = 0; i < fileInputs.length; i++) {
                const fileInput = fileInputs[i];
                if (fileInput.files.length > 0) {
                    formData.append(`file_${i+1}`, fileInput.files[0]);
                }
            }
            axios.post('/api/edit_product_data',formData).then(Response =>{
              if(Response.data.text != "" || Response.data.text != undefined){
                const message = Response.data.text;
                if(message == 'FailedUpdatingProduct'){
                  createAlert('warning', 'Failed Updating Product', '');
                }
                if(message == 'ProductUpdatedSuccessfully'){
                  createAlert('success', 'Product Updated SuccessFully',"");
                  document.querySelector('.temp-form').remove();
                  const scripts = document.querySelectorAll('.addProScript')
                  scripts[0].remove();
                  scripts[1].remove();
                  
                }
                if(message == 'trayingToRemoveAllFileErr'){
                  createAlert('danger', 'Please de-select one check box ', '');
                }
                if(message =='CategoryAlreadyAvailable' ){
                  createAlert('danger', 'Category already available', '');
                }if(message == 'FailedCreatingCategory'){
                  createAlert('warning', 'Failed creating Category', '');
                }
              }
                console.log(Response);
            }).catch(err =>{
              console.log(err)
            })
            // console.log(formData);
        }
    }
  }
function checkInputEditPro(data){
    let count = 0;
    let checkBoxes = document.querySelectorAll('.remove')
    checkBoxes.forEach(element => {
        if(element.checked == true){
            count ++;
        }
    });
    if(count == 5){
        count = 0;
        createAlert('warning', 'please Deselect one checkbox');
        return;
    }
    data.forEach((element, index) => {
        if(index == 'img_dir'){
          return 0;
        }

        if(element == ""){
            console.log(element);
            createAlert('warning', `Please fill ${index}`, '');
        }
        if (index === "product_price") {
            const regex = /^\d+(\.\d{1,2})?$/;
    
            if (regex.test(element)) {
            } else {
              // Invalid input
              createAlert("warning", `Please Enter <b>Valid Price </b>`, "");
              return 0;
            }
        }
        
          if(index == 'QOH' && parseInt(element) < 0){
            createAlert('warning', 'Please Enter valid quantity', '');
          }
          if (index === "product_title" && element.length > 255) {
            createAlert(
              "warning",
              `Please Enter small title  max length <b>255</b> charcters on <b>Title </b>`,
              ""
            );
            return 0;
          } else if (index === "product_desc" && element.length > 1000) {
            createAlert(
              "warning",
              `Please Enter small title  max length <b>1000</b> charcters on <b>description </b>`,
              ""
            );
            return 0;
          } else if (element === "qoh" && element < 0) {
            createAlert("warning", `Please Enter A Valid  <b>Qoh </b>`, "");
            return 0;
          }
    });
    // return checkCategory();
    return 1;
}
// function checkCategory(){
//   let new_category = document.querySelector('.new_cat');
//   console.log(new_category.disabled);
//     if (new_category.disabled == false) {
//       const options = document.querySelectorAll(".option");
//       for(let Element of options){
//         console.log(Element.value);
//         if(new_category.value == ""){
//           createAlert("warning", `Please Enter Value In <b>New category </b>`, "");
//           return 0;
//         }
//         if (Element.value.toUpperCase().trim() === new_category.value.toUpperCase().trim()) {
//           createAlert("warning", ` <b>Category </b> already Available`, "");
//           return 0;
//         }
//         if (new_category.value.trim().length > 100) {
//           createAlert(
//             "warning",
//             `Please Enter small name  max length <b>100</b> charcters on <b>New category </b>`,
//             ""
//           );
//           return 0;
//         }
//       }
//     }
//     console.log('from here');
//     return 1;
// }
function checkImgs(){
    let count = 0;
    let labl = document.querySelectorAll('.img-text');
    let imgs = document.querySelectorAll('.pro-img')
    let boxes = document.querySelectorAll('.remove')
    imgs.forEach((element, index)=>{
        // let file = element.files[0];
        // console.log(labl[index].textContent)

        if(element.files[0] == 0 || labl[index].textContent == "" ){
            count ++;
        }
        if( element.files[0] != 0 && labl[index].textContent != "" && boxes[index].checked == true){
            console.log('in');
            count ++;
        }
        else if(element.files[0] != 0 && labl[index].textContent != "" && boxes[index].checked == false){
            // console.log(/(\.jpg|\.jpeg|\.png)$/i.test('.jpg'));
            if(checkImgType(labl[index].textContent)){
                createAlert('warning', 'Please select file in <b>PNG, JPG or JPEG </b> format','');
                return 0;
            }
        }
    })
    console.log(count);
    if(count >= 5){
        createAlert('warning', 'please add image ', '');
        return 0;
    }else{
        return 1;
    }
}

function checkImgType(name){
    const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
        const fileExtension = name.split('.').pop();

        return (!allowedExtensions.exec("." + fileExtension))
}

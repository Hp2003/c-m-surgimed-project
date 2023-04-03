{
// console.log('hello world');
let closePopoverBtn 
if(typeof closePopoverBtn === 'undefined' ){
    closePopoverBtn= document.querySelector(".closeAddProduct");
    // console.log(closePopoverBtn)
}


closePopoverBtn.addEventListener("click", (e) => {

    e.preventDefault();
    const Form = document.querySelector(".temp-form");

    let scripts = document.querySelectorAll(".addProScript");
    
    Form.remove();
    scripts[0].remove();
    scripts[1].remove();1

  });
// rendring img names
let parentElement = document.querySelector('.main-prev');
let displayBlocks = parentElement.querySelectorAll('.img-name');

function displayImgs(imgObj){
	for(let i = 0 ; i<imgObj.files.length ; i++){
		// document.querySelector('.main-prev').innerHTML += `<input type="text" value =  data-index = "${i}"name="" id="" class="form-outline  w-75 pt-3 m-auto mb-4 text-white img-name" disabled>`;
        displayBlocks[i].value = `${imgObj.files.item(i).name}`;
        displayBlocks[i].style.display = `block`;

	}
}

// let productImgName;
// let checkInput = document.querySelector('.check')
// checkInput.addEventListener('click', ()=>{
//     if( checkInput.checked == true ){
//         document.querySelector('.new_cat').disabled = false;
//         document.querySelector('.dropDown').disabled = true;
        
//     }else if(checkInput.checked == false){
//         document.querySelector('.new_cat').disabled = true;
//         document.querySelector('.dropDown').disabled = false;
//         document.querySelector('.new_cat').value = "";
//     }
// })


// checking how many images selected
const proImgs = document.querySelector('.productImg')
let oldSize = 0;
proImgs.addEventListener('change', ()=>{
    if(proImgs.files.length > 5){
        createAlert('warning', 'warning! ', 'Maximum 5 images allowed');
        removeElems();
        proImgs.value = "";
    }else{
        checkFile(proImgs);
        displayImgs(proImgs);
        
        oldSize = proImgs.files.length;
    }
})

// checking file type
function checkFile(images){
    for(let i = 0 ; i< images.files.length ; i++){

        if (images.files.item(i).name.endsWith(".png") || images.files.item(i).name.endsWith(".jpg") || images.files.item(i).name.endsWith(".jpeg")) {
            createAlert('success', 'fileSupported','');
            
        } else {
            createAlert('warning', 'file should be in <b>PNG, JPG, JPEG </b> only','');
            removeElems();
            proImgs.value = "";
        }   
    }
}


function removeElems(imgObj){
    // console.log(proImgs.files.length);
    for(let i = 0 ; i<oldSize ; i++){
		// document.querySelector('.main-prev').innerHTML += `<input type="text" value =  data-index = "${i}"name="" id="" class="form-outline  w-75 pt-3 m-auto mb-4 text-white img-name" disabled>`;
        displayBlocks[i].value = ``;
        displayBlocks[i].style.display = `none`;

	}
}

// console.log('here');
function getMainCategorys(){
    let formData = new FormData();
    
    let container = document.querySelector('.mainCategorys');
    formData.append('process_forProPage',`getMainCategory`);
    axios.post('/api/get_categorys_brands_and_sub_categorys', formData,  { responseType: 'json' }).then(Response =>{
        console.log(Response.data);
        Response.data.text.forEach(element => {
                container.innerHTML += `<option value="${element.MainCategoryId}"  >${element.MainCategoryName}</option>`;
            });
        })
    }
    getMainCategorys();
}
function getSubCategory(event, selectedElement){
    let formData = new FormData();
    
    let container = document.querySelector('.sub_category');
    container.innerHTML = '';
    formData.append('process_forProPage',`getSubCategory`);
    formData.append('mainCategoryId',selectedElement.value);

    axios.post('/api/get_categorys_brands_and_sub_categorys', formData,  { responseType: 'json' }).then(Response =>{
        console.log(Response.data);
        Response.data.text.forEach(element => {
            
            container.innerHTML += `<option value="${element.CategoryId}"  >${element.CategoryName}</option>`;
        });
    })
}



function getBrands(){
    let formData = new FormData();
    
    let container = document.querySelector('.brand');

    formData.append('process_forProPage',`getbrands`);
    // formData.append('mainCategoryId',selectedElement.value);

    axios.post('/api/get_categorys_brands_and_sub_categorys', formData,  { responseType: 'json' }).then(Response =>{
        console.log(Response.data);
        Response.data.text.forEach(element => {
            
            container.innerHTML += `<option value="${element.BrandId}"  >${element.BrandName}</option>`;
        });
    })
}
getBrands();
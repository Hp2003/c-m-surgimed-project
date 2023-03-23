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

let productImgName;
let checkInput = document.querySelector('.check')
checkInput.addEventListener('click', ()=>{
    if( checkInput.checked == true ){
        document.querySelector('.new_cat').disabled = false;
        document.querySelector('.dropDown').disabled = true;
        
    }else if(checkInput.checked == false){
        document.querySelector('.new_cat').disabled = true;
        document.querySelector('.dropDown').disabled = false;
        document.querySelector('.new_cat').value = "";
    }
})


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

}
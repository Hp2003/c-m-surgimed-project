{
  // console.log('hello world');
    const Form = document.querySelector(".temp-form");
    const closePopoverBtnEditPro = document.querySelector(".closeEditForm");
    if (closePopoverBtnEditPro !== null) {
      // console.log("in");
      closePopoverBtnEditPro.addEventListener("click", (e) => {
        e.preventDefault();
        let scripts = document.querySelectorAll('.editProductScript');
        Form.remove();
        scripts.forEach(Element =>{
            Element.remove();
        })
        
      });
      document.querySelector('.new_cat').disabled = true;
      let checkInput = document.querySelector('.check')
    checkInput.addEventListener('click', ()=>{
      console.log('in')
    if( checkInput.checked == true ){
        document.querySelector('.new_cat').disabled = false;
        document.querySelector('.dropDown').disabled = true;
        
    }else if(checkInput.checked == false){
        document.querySelector('.new_cat').disabled = true;
        document.querySelector('.dropDown').disabled = false;
        document.querySelector('.new_cat').value = "";
    }
})
    }
    let imgView = document.querySelectorAll('.img-name');
    imgView.forEach((element, index)=>{
    element.addEventListener('click', (e)=>{
    console.log('click');
  })
})
    
}
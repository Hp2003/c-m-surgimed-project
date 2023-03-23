{
    const Form = document.querySelector(".temp-form");
    const closePopoverBtnEditPro = document.querySelector(".closeEditForm");
    if (closePopoverBtnEditPro !== null) {
    //   console.log("in");
      closePopoverBtnEditPro.addEventListener("click", (e) => {
        e.preventDefault();
        let scripts = document.querySelectorAll('.editProductScript');
        Form.remove();
        scripts.forEach(Element =>{
            Element.remove();
        })
        
      });
    }
}
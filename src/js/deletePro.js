{
const deleteBtn = document.querySelectorAll('.deleteProBtn');
const delteProduct = document.querySelectorAll('.cartForm');
const delteProductCards = document.querySelectorAll('.cards');
deleteBtn.forEach((Element, Index)=>{
  Element.addEventListener('click', (e)=>{
    let formData = new FormData(delteProduct[Index]);

    e.preventDefault();
    axios.post('/api/remove_product',formData).then(Response =>{
        if(Response.data.text != '' && Response.data.text != ''){
            if(Response.data.text === 'deleted'){
                delteProductCards[Index].style.display = 'none';
                createAlert('success',"Product has been deleted!",'');
            }   
            console.log(Response.data)
        }   
    })
  })
})
}
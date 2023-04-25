
const deleteBtn = document.querySelectorAll('.deleteProBtn');
const delteProduct = document.querySelectorAll('.cartForm');
const delteProductCards = document.querySelectorAll('.cards');
deleteBtn.forEach((Element, Index)=>{
  Element.addEventListener('click', (e)=>{
    let formData = new FormData(delteProduct[Index]);

    e.preventDefault();
    const confirm = window.confirm('Do you really want to delete this product?');
    if(confirm){
      axios.post('/api/remove_product',formData).then(Response =>{
          if(Response.data.text != '' && Response.data.text != ''){
              if(Response.data.text === 'deleted'){
                  delteProductCards[Index].style.display = 'none';
                  createAlert('success',"Product has been deleted!",'');
              }   
              console.log(Response.data)
          }   
      })
    }
  })
})

function deleteProduct(event, button , index){
  const delproduct = document.querySelectorAll('.cartForm');
  
  const cards = document.querySelectorAll('.cards');
  event.preventDefault();

  let formData = new FormData(delproduct[index]);
  const confirm  = window.confirm('Do you Really want to delete This Product :');
  if(confirm){
    axios.post('/api/remove_product',formData).then(Response =>{
      if(Response.data.text != '' && Response.data.text != ''){
          if(Response.data.text === 'deleted'){
              cards[index].style.display = 'none';
              createAlert('success',"Product has been deleted!",'');
          }   
          console.log(Response.data)
      }   
  })
  }

}
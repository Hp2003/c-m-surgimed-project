let addToCartBtns = document.querySelectorAll('.addToCart');
let cartData = document.querySelectorAll('.cartForm');
let imgs = document.querySelectorAll('.banner-img');
addToCartBtns.forEach((Element, Index) =>{
    Element.addEventListener('click', (e)=>{
        e.preventDefault();
        const formData = new FormData(cartData[Index]);
        formData.append('Item_Image', imgs[Index].src);

        axios.post('/api/add_to_cart', formData).then(Response =>{
            console.log(Response.data);
        })
    })
})
const alertMessage = localStorage.getItem('alertMessage');
const alertType = localStorage.getItem('alertType');

if (alertMessage && alertType) {
    localStorage.removeItem('alertMessage');
    localStorage.removeItem('alertType');
    createAlert(alertType, alertMessage, '');
}

let changeQtyBtn = document.querySelectorAll('.iqty')
let increaseQtyForms = document.querySelectorAll('.increaseqty')

changeQtyBtn.forEach((Element, index)=>{
  Element.addEventListener('change', (e)=>{
    e.preventDefault();
    const formData = new FormData(increaseQtyForms[index]);
    formData.append('process', 'increase_decrease');
    axios.post('/cart', formData).then(Response =>{
        console.log(Response);
    })
  })
})

let rmbtn = document.querySelectorAll('.rmbtn');
// console.log(rmbtn);
let rmform = document.querySelectorAll('.rmporduct');
let justRemoved = false;
rmbtn.forEach((element , index)=> {
    element.addEventListener('click', (e)=>{
        e.preventDefault();
        let formData = new FormData(rmform[index]);
        formData.append('process', 'remove');
        axios.post('/cart', formData).then(Response =>{
            if(Response.data.text != undefined && Response.data.text != ''){
                if(Response.data.text === 'removed'){
                    justRemoved = true;
                    window.location.href = '/cart';
                    const alertMessage = 'Product removed from cart!!';
                    const alertType = 'success';
                    localStorage.setItem('alertMessage', alertMessage);
                    localStorage.setItem('alertType', alertType);

                    // createAlert('success', 'Product removed from cart!!','');
                }
            }
        })
    })
});




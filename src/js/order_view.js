
function placeOrder(e,btn){
    e.preventDefault();

    let formData = new FormData();
    let ids = document.querySelectorAll('.Item_Id');
    let qty = document.querySelectorAll('.iqty')
    const qtyArray = Array.from(qty).map(item => item.value);
    const idArray = Array.from(ids).map(item => item.value);
    const address = document.querySelector('.add').value;
    const phno = document.querySelector('.pno').value;
    if(address.length < 12){
        createAlert('warning', 'Please enter valid address..','');
        return;
    }else if(phno < 10 ){
        createAlert('warning', 'Please enter valid phone number..','');
        return;
    }
    formData.append('orderPageProcess', 'getOrderPage');
    formData.append('item_ids' , idArray);
    formData.append('item_quentity' , qtyArray);
    formData.append('phone_number' , phno );
    formData.append('address' ,address );
    // formData.append('fname' , document.querySelector('.fname'));
    // formData.append('method' , document.querySelectorAll('.'));
    axios.post('/api/place_order',formData).then(Response =>{
        console.log(Response);
        if(Response.data.text == 'notLoggedin'){
            createAlert('warning', 'Please Login..','');
        }
        if(Response.data.text == 'placed'){
            createAlert('success', 'order placed..','');
        }
        if(Response.data.text == 'quantityIsNotAvilable'){
            createAlert('success', `Quantity not available for ${document.querySelectorAll('.itemName')[Response.data.index].value}..`,'');
        }
    })
}
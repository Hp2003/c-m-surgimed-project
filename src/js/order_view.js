
function placeOrder(e,btn){
    e.preventDefault();

    let ids = document.querySelectorAll('.Item_Id');
let qty = document.querySelectorAll('.iqty')
    const qtyArray = Array.from(qty).map(item => item.value);
    const idArray = Array.from(ids).map(item => item.value);
    const address = document.querySelector('.add').value;
    const phno = document.querySelector('.pno').value;
    if(address.length < 12){
        createAlert('warning', 'Please enter valid address..','');
        return;
    }else if(phno < 15 ){
        createAlert('warning', 'Please enter valid phone number..','');
        return;
    }
    var userInputTime = document.querySelector('.time-min').value;
    var currentTime = (new Date().getHours() + 1 ) +  ':' + new Date().getMinutes();

    if (userInputTime.localeCompare(currentTime) === -1 ) {
    // console.log("The user input time is less than the current time.");
    createAlert('warning', 'Please enter valid Time..','');
        return;
    } else {
        let formData = new FormData(document.querySelector('#purchaseForm'));

        formData.append('orderPageProcess', 'getOrderPage');
        formData.append('item_ids' , idArray);
        formData.append('item_quentity' , qtyArray);
        // formData.append('phone_number' , phno );
        // formData.append('address' ,address );
        axios.post('/api/place_order',formData).then(Response =>{
            console.log(Response);
            if(Response.data.text == 'notLoggedin'){
                createAlert('warning', 'Please Login..','');
            }
            if(Response.data.text == 'placed'){
                createAlert('success', 'order placed..','');
            window.location.reload()
        }
        if(Response.data.text == 'quantityIsNotAvilable'){
            console.log(document.querySelectorAll('.itemName')[Response.data.index].childNodes[0]);
            createAlert('success', `Quantity not available for `,'');
        }
        })
    }
}


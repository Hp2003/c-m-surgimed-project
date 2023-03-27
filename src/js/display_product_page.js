function get_details(event, btn, index){
    event.preventDefault();
    // getting page and details
        // console.log(document.querySelectorAll('.item_id')[index].value)
        if(document.querySelector('.tempDetailMain') != undefined){
            document.querySelector('.tempDetailMain').remove();
        }
        let formData = new FormData();
        formData.append('productId', document.querySelectorAll('.item_id')[index].value);
    axios.post('/api/get_details_page', formData).then(Response =>{
        console.log(Response.data.details);
            let newElem = document.createElement('div');
            newElem.innerHTML = Response.data.html;
            newElem.style.height = '100%';
            newElem.classList.add('tempDetailMain')  ;
            newElem.style.width = '100%';
            newElem.style.top = '0';
            newElem.style.position = 'absolute';
            newElem.style.pointerEvents = 'none';
            newElem.querySelectorAll('*').forEach(child => child.style.pointerEvents = 'auto')
            document.body.scrollTop = 0; // For Safari
            document.documentElement.scrollTop = 0
            document.body.appendChild(newElem);

            addDataInProductPage(Response.data.details);
    })
}
function closeContainer(event){
    event.preventDefault();
    document.querySelector('.tempDetailMain').remove();

    // Set the scrollTop property to scroll to the bottom of the page
    document.documentElement.scrollTop =  491;
}

function addDataInProductPage(data){
    document.querySelector('.title').textContent = data.ProductTitle;
    document.querySelector('.price').textContent = data.ProductPrice;
    document.querySelector('.stock').textContent = data.QuantityOnHand;
    document.querySelector('.desc').textContent = data.ProductDesc;
    document.querySelector('.biggerImg').src = data.imgs[0];

    let imgs = document.querySelectorAll('.small-img')
    imgs.forEach((Element, index)=>{
        if(data.imgs[index] != null || data.imgs[index] != undefined){
            Element.src = data.imgs[index];
        }else{
            Element.remove();
        }
    })

}